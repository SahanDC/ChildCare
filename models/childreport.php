<?php 
    include_once('dbh.php');

    class ChildReport{
        public $Errors = array();
        protected $database;
        protected $ChildId;
        private $name;
        private $age;
        private $guardian;
        private $birth_place;
        private $last_vaccination;
        private $weights;
        protected $vaccine_data;

        public function __construct($childid){
            $this->ChildId=trim($childid);
            $this->database= new Dbh();

        }

        public static $vaccine = array("BCG Vaccine", "Triple Vaccine", "Triple/Polio Vaccine", "MMR Vaccine", "Japanese Encephalitis Vaccine", "Dual Polio Vaccine", "Hepatitis A, B Vaccine (there are separate vaccines for both A and B as well)", "Anti Rabies Vaccine", "Chicken Pox Vaccine", "Meningicoccal Vaccine");
        public static $vaccine_db_fields = array("BCG", 'Triple', 'Triple_Polio', 'MMR', 'Japanese_Encephalitis', 'Dual_Polio', 'Hepatitis_AB', 'Anti_Rabies', 'Chicken_Pox', 'Meningicoccal');
        public static $prevents = array("Tuberculosis", "Diptheria/Tetanus/Whooping Cough", "Diptheria/Tetanus/Whooping Cough and Polio", "Measles, Mumps and Rubella", "Japanese Encephalitis", "Polio", "Hepatitis A+B", "Rabies", "Chicken Pox", "Meningitis");

//-------------------getters and setters-------------------------------------------------------

        public function getChildId(){   return $this->ChildId;}
        public function setChildId($ChildId){   $this->ChildId = $ChildId;  return $this;   }

        public function getName(){  return $this->name; }
        public function setName($name){ $this->name = $name;    return $this;   }

        public function getAge(){   return $this->age;  }
        public function setAge($age){   $this->age = $age;  return $this;   }

        public function getGuardian(){  return $this->guardian; }
        public function setGuardian($guardian){ $this->guardian = $guardian;    return $this;   }

        public function getBirthPlace(){    return $this->birth_place;  }
        public function setBirthPlace($birth_place){    $this->birth_place = $birth_place;  return $this;   }

        public function getLastVaccination(){   return $this->last_vaccination; }
        public function setLastVaccination($last_vaccination){  $this->last_vaccination = $last_vaccination;    return $this;   }

        public function getVaccineData(){   return $this->vaccine_data; }
        public function setVaccineData($vaccine_data){  $this->vaccine_data = $vaccine_data;    return $this;   }

        public function getWeights(){   return $this->weights;  }
        public function setWeights($weights){   $this->weights = $weights;  return $this;   }


//----------------------data view functiins--------------------------------------- 

        public function showVaccinations(){
            $this->get_details();
            for ($i = 0; $i < 10; $i++) {
                echo "<tr class=' border-2'>
                    <td class='col-2 text-break'>" . self::$vaccine[$i] . "</td>";
                if (strcmp($this->vaccine_data[$i], "")) {
                    $curr_vaccine = explode("_", $this->vaccine_data[$i]);
                    echo "<td class='col-2 border-2 text-break text-center'>" . $curr_vaccine[0] . "</td>";
                    echo "<td class='col-2 border-2 text-break text-center'>" . $curr_vaccine[1] . "</td>";
                } else {
                    echo "<td class=' border-2'> </td>
                        <td class=' border-2' > </td>";
                }
                echo "<td class='col-2 border-2 text-break'>" . self::$prevents[$i]. "</td>";
                if (strcmp($this->vaccine_data[$i], "")) {
                    if (strlen($curr_vaccine[2]) == 0) {
                        echo "<td class='col-2 border-2 text-center'> - </td>";
                    } else {
                        echo "<td class='col-2 border-2 text-break'>" .  $curr_vaccine[2] . "</td>";
                    }
                } else {
                    echo "<td class=' border-2' > </td>";
                }
                echo "</tr>";
            }
        }


        public function showWeight(){
            if ($this->getWeights() == null) {
                $this->get_details();
                echo "null";
            }
            if ($this->getWeights()[0] != '') {
                for ($j = 0; $j < count($this->getWeights()); $j++) {
                    $curr_weights = explode("_", $this->getWeights()[$j]);
                    $var_date = strtotime($curr_weights[0]);
                    echo "<tr class='border-2'>
                            <td class='col-2 border-2 text-break'>" .  $curr_weights[0] . "</td>
                            <td class='col-2 border-2 text-break'>" . $curr_weights[1] . "</td>
                            </tr>";
                }
            }
            // print_r($weight_chart);
    }


    public function getWeightArray(){
        $var_date = null;
            $weight_chart = "[";
            if ($this->getWeights()[0] != '') {
                for ($j = 0; $j < count($this->getWeights()); $j++) {
                    $curr_weights = explode("_", $this->getWeights()[$j]);
                    if ($j > 0) {
                        $diff = round(abs(strtotime($curr_weights[0]) - $var_date) / (30 * 24 * 60 * 60));
                        for ($k = 0; $k < $diff - 1; $k++) {
                            $weight_chart .= null;
                            $weight_chart .= ",";
                        }
                    }
                    $weight_chart .= $curr_weights[1] . ",";
                    $var_date = strtotime($curr_weights[0]);
                }
            }
            $weight_chart .= "]";
            return $weight_chart;
    }


    public function checkErrors(){
        if (empty($this->Errors)) {
            return true;
        }
        else{
            return false;
        }
    }


//----------------------modifing data functions-------------------------------------- 

    public function openChildReport(){
        if($this->emptyChildId() == false){
            header("location: child_report.php?error=emptyinput");
            exit();
        }
        
        $this->get_details();
    }


    public function editVaccination($name, $date, $place, $nvdate, $comment){
        if ($name != '-1') {
            $req_fields=array($date, $place, $nvdate);
            $field_names=array("Date of Vaccination","Place of Vaccination","Next vaccination Date");
            $this->check_req_fields($req_fields,$field_names);
            $edit_field = date("Y/m/d", strtotime($date)) . '_' . $place . '_' . $comment;
            $this->checkLength($edit_field,200,"Comment");
        }
        else{
            array_push($this->Errors,"Select a Vaccine");
        }
        if (empty($this->Errors)) {
            if(!$this->setVaccination($name,$edit_field, $nvdate)){
                array_push($this->Errors,"Fail to enter vaccination details");
            }
        }
    }


    public function addVaccination($name, $date, $place, $nvdate, $comment){
        $this->editVaccination($name, $date, $place, $nvdate, $comment);
    }


    public function addWeight($pre_weights,$date,$add_weight){
        $req_fields=array($date,$add_weight);
        $field_names=array("Date of weight cheked","Weight");
        $this->check_req_fields($req_fields,$field_names);
        $add_Wfield =$pre_weights . ',' . date("Y/m/d", strtotime($date)) . '_' . $add_weight;
        
        if (empty($this->Errors)) {
            if(!$this->setWeight($add_Wfield)){
                array_push($this->Errors,"Fail to add Weight details");
            }
        }
    }


//----------------------error handling-------------------------------------- 


    private function emptyChildId(){
        $result = false;
        if(empty($this->ChildId)){
            $result =false;
        }
        else{
            $result =true;
        }
        return $result;
    }


    // checks required fields
    private function check_req_fields($req_fields,$field_names){
        for ($i=0 ;  $i<sizeof($req_fields) ; $i++) { 
            if (empty(trim($req_fields[$i]))) {
                array_push($this->Errors, $field_names[$i] . ' is required.');
            }
        }
    }


    private function checkLength($field,$len,$field_name){
        if (strlen($field) > $len) {
            array_push($this->Errors, $field_name . " is too long.");
        }
    }

//----------------------database access functions--------------------------------------


        private function get_details(){
            
            $query = "SELECT * FROM child_report WHERE ChildId = {$this->ChildId}";
            $result_set = mysqli_query($this->database->connect(),$query);
            
            if ($result_set) {

                if(mysqli_num_rows($result_set) == 0){
                    array_push($this->Errors,"Childreport not found");
                    //header("location: child__report.php?error=childreportnotfound&ChildId={$this->ChildId}");
                }
                else{
                    $report = mysqli_fetch_assoc($result_set);
                    $this->name = $report["Name"];
                    $this->age = round((strtotime(date("Y-m-d", time())) - strtotime($report['Birthday'])) / (60 * 60 * 24 * 30));
                    $this->guardian = $report["Guardian"];
                    $this->birth_place = $report["BirthPlace"];
                    $this->vaccine_data   = array($report['BCG'], $report['Triple'], $report['Triple_Polio'], $report['MMR'], $report['Japanese_Encephalitis'], $report['Dual_Polio'], $report['Hepatitis_AB'], $report['Anti_Rabies'], $report['Chicken_Pox'], $report['Meningicoccal']);
                    $this->weights = explode(',', $report['Weight']);
                    for ($v = 0; $v < count($this->vaccine_data); $v++) {
                        if (empty($vaccine_data[$v])) {
                            $last_vaccination = $v;
                            break;
                        }
                    }
                }
            }
            else{
                array_push($this->Errors,"Fail database");
                //header("location: child_report.php?error=stmtfailed&ChildId={$this->ChildId}");
            }
        }


        private function setVaccination($name, $edit_field,$nvdate){
            $query = "UPDATE child_report SET " . self::$vaccine_db_fields[(int)$name] . " = '{$edit_field}' , NVD = '{$nvdate}' WHERE ChildId = {$this->ChildId} LIMIT 1";
            $result_set = mysqli_query($this->database->connect(),$query);
            if (!$result_set) {
                return false;
            }
            return true;
        }


        private function setWeight($add_Wfield){
            $query = "UPDATE child_report SET Weight = '{$add_Wfield}' WHERE ChildId = {$this->ChildId} LIMIT 1";
            $result_set = mysqli_query($this->database->connect(),$query);
            if (!$result_set) {
                return false;
            }
            return true;
        }
        
    }
?>