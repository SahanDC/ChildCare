<?php
include_once('dbh.php');
//include('controllers/autoloader.php');

// $requestObj = new Request($connection);

class ChildReport
{
    public $Errors = array();
    protected $database;
    protected $ChildId;
    private $name;
    private $age;
    private $guardian;
    private $requestId;
    private $area;
    private $centre;
    private $NVD;
    private $birth_place;
    private $last_vaccination;
    private $weights;
    protected $vaccine_data;
    private static $child_reports = array();

    private function __construct($childid)
    {
        $this->ChildId = trim($childid);
        $this->database = new Dbh();
    }

    public static $vaccine = array("BCG Vaccine", "Triple Vaccine", "Triple/Polio Vaccine", "MMR Vaccine", "Japanese Encephalitis Vaccine", "Dual Polio Vaccine", "Hepatitis A, B Vaccine (there are separate vaccines for both A and B as well)", "Anti Rabies Vaccine", "Chicken Pox Vaccine", "Meningicoccal Vaccine");
    public static $vaccine_db_fields = array("BCG", 'Triple', 'Triple_Polio', 'MMR', 'Japanese_Encephalitis', 'Dual_Polio', 'Hepatitis_AB', 'Anti_Rabies', 'Chicken_Pox', 'Meningicoccal');
    public static $prevents = array("Tuberculosis", "Diptheria/Tetanus/Whooping Cough", "Diptheria/Tetanus/Whooping Cough and Polio", "Measles, Mumps and Rubella", "Japanese Encephalitis", "Polio", "Hepatitis A+B", "Rabies", "Chicken Pox", "Meningitis");

    //-------------------getters and setters-------------------------------------------------------

    public function getChildId()
    {
        return $this->ChildId;
    }
    public function setChildId($ChildId)
    {
        $this->ChildId = $ChildId;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function getGuardian()
    {
        return $this->guardian;
    }
    public function setGuardian($guardian)
    {
        $this->guardian = $guardian;
        return $this;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }
    public function setRequestID($requestId)
    {
        $this->requestId = $requestId;
        return $this;
    }

    public function getArea()
    {
        return $this->area;
    }
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    public function getCentre()
    {
        return $this->centre;
    }
    public function setCentre($centre)
    {
        $this->centre = $centre;
        return $this;
    }

    public function getNVD()
    {
        return $this->NVD;
    }
    public function setNVD($NVD)
    {
        $this->NVD = $NVD;
        return $this;
    }

    public function getBirthPlace()
    {
        return $this->birth_place;
    }
    public function setBirthPlace($birth_place)
    {
        $this->birth_place = $birth_place;
        return $this;
    }

    public function getLastVaccination()
    {
        return $this->last_vaccination;
    }
    public function setLastVaccination($last_vaccination)
    {
        $this->last_vaccination = $last_vaccination;
        return $this;
    }

    public function getVaccineData()
    {
        return $this->vaccine_data;
    }
    public function setVaccineData($vaccine_data)
    {
        $this->vaccine_data = $vaccine_data;
        return $this;
    }

    public function getWeights()
    {
        return $this->weights;
    }
    public function setWeights($weights)
    {
        $this->weights = $weights;
        return $this;
    }

        //----------------------- get child report --------------------------------------
        public static function getChildreport($childid){
            if (array_key_exists($childid,self :: $child_reports)){
                if(!empty(self :: $child_reports[$childid])){
                    return self:: $child_reports[$childid];
                }else{
                    return new ChildReport($childid);
                }
            }else{
                return new ChildReport($childid);
            }
        }
        public static function cloneChildreport(){
            if (array_key_exists(20,self :: $child_reports)){
                if(!empty(self :: $child_reports[20])){
                    return self:: $child_reports[20];
                }else{
                    return new ChildReport(20);
                }
            }else{
                return new ChildReport(20);
            }
        }
    

    //----------------------data view functiins--------------------------------------- 

    public function showVaccinations()
    {
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
            echo "<td class='col-2 border-2 text-break'>" . self::$prevents[$i] . "</td>";
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


    public function showWeight()
    {
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


    public function getWeightArray()
    {
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


    public function checkErrors()
    {
        if (empty($this->Errors)) {
            return true;
        } else {
            return false;
        }
    }


    public function addDetails(array $array)
    {
        $this->name = $array['Name'];
        $this->guardian = $array['Guardian'];
        $this->area = $array['Area'];
        $this->NVD = $array['NVD'];
        $this->centre = $array["Centre"];
    }

    //----------------------modifing data functions-------------------------------------- 

    public function openChildReport()
    {
        if ($this->emptyChildId() == false) {
            header("location: child_report.php?error=emptyinput");
            exit();
        }

        $this->get_details();
    }


    public function editVaccination($name, $date, $place, $nvdate, $comment)
    {
        if ($name != '-1') {
            $req_fields = array($date, $place, $nvdate);
            $field_names = array("Date of Vaccination", "Place of Vaccination", "Next vaccination Date");
            $this->check_req_fields($req_fields, $field_names);
            $edit_field = date("Y/m/d", strtotime($date)) . '_' . $place . '_' . $comment;
            $this->checkLength($edit_field, 200, "Comment");
        } else {
            array_push($this->Errors, "Select a Vaccine");
        }
        if (empty($this->Errors)) {
            if (!$this->setVaccination($name, $edit_field, $nvdate)) {
                array_push($this->Errors, "Fail to enter vaccination details");
            }
        }
    }


    public function addVaccination($name, $date, $place, $nvdate, $comment)
    {
        $this->editVaccination($name, $date, $place, $nvdate, $comment);
    }


    public function addWeight($pre_weights, $date, $add_weight)
    {
        $req_fields = array($date, $add_weight);
        $field_names = array("Date of weight cheked", "Weight");
        $this->check_req_fields($req_fields, $field_names);
        $add_Wfield = $pre_weights . ',' . date("Y/m/d", strtotime($date)) . '_' . $add_weight;

        if (empty($this->Errors)) {
            if (!$this->setWeight($add_Wfield)) {
                array_push($this->Errors, "Fail to add Weight details");
            }
        }
    }


    //----------------------error handling-------------------------------------- 


    private function emptyChildId()
    {
        $result = false;
        if (empty($this->ChildId)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }


    // checks required fields
    private function check_req_fields($req_fields, $field_names)
    {
        for ($i = 0; $i < sizeof($req_fields); $i++) {
            if (empty(trim($req_fields[$i]))) {
                array_push($this->Errors, $field_names[$i] . ' is required.');
            }
        }
    }


    private function checkLength($field, $len, $field_name)
    {
        if (strlen($field) > $len) {
            array_push($this->Errors, $field_name . " is too long.");
        }
    }


    //----------------------database access functions--------------------------------------


    private function get_details()
    {

        $query = "SELECT * FROM child_report WHERE ChildId = {$this->ChildId}";
        $result_set = mysqli_query($this->database->connect(), $query);

        if ($result_set) {

            if (mysqli_num_rows($result_set) == 0) {
                array_push($this->Errors, "Childreport not found");
                //header("location: child__report.php?error=childreportnotfound&ChildId={$this->ChildId}");
            } else {
                $report = mysqli_fetch_assoc($result_set);
                $this->name = $report["Name"];
                $this->age = round((strtotime(date("Y-m-d", time())) - strtotime($report['Birthday'])) / (60 * 60 * 24 * 30));
                $this->guardian = $report["Guardian"];
                $this->requestId = $report["RequestId"];
                $this->area = $report["Area"];
                $this->centre = $report["Centre"];
                $this->NVD = $report["NVD"];
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
        } else {
            array_push($this->Errors, "Fail database");
            //header("location: child_report.php?error=stmtfailed&ChildId={$this->ChildId}");
        }
    }


    private function setVaccination($name, $edit_field, $nvdate)
    {
        $query = "UPDATE child_report SET " . self::$vaccine_db_fields[(int)$name] . " = '{$edit_field}' , NVD = '{$nvdate}' WHERE ChildId = {$this->ChildId} LIMIT 1";
        $result_set = mysqli_query($this->database->connect(), $query);
        if (!$result_set) {
            return false;
        }
        return true;
    }


    private function setWeight($add_Wfield)
    {
        $query = "UPDATE child_report SET Weight = '{$add_Wfield}' WHERE ChildId = {$this->ChildId} LIMIT 1";
        $result_set = mysqli_query($this->database->connect(), $query);
        if (!$result_set) {
            return false;
        }
        return true;
    }


    public function createChildReport($child_name, $birthday, $guardian, $guardian_id,$Request_id,$birth_place, $area, $center, $midwife_email, $NVD, $vaccines)
    {
        $vaccine_name = array("BCG Vaccine", "Triple Vaccine", "Triple/Polio Vaccine", "MMR Vaccine", "Japanese Encephalitis Vaccine", "Dual Polio Vaccine", "Hepatitis A, B Vaccine (there are separate vaccines for both A and B as well)", "Anti Rabies Vaccine", "Chicken Pox Vaccine", "Meningicoccal Vaccine");
        $req_fields = array($child_name, $birthday, $guardian, $guardian_id,$Request_id,$birth_place, $area, $center, $midwife_email, $NVD);
        $field_names = array("Name", "Birthday", "Guardian", "Guardian ID","Request Id", "Birth Place", "Area", "Centre", "Midwife email", "Next vaccination date");
        $this->check_req_fields($req_fields, $field_names);
        // print_r($vaccines);
        foreach ($vaccines as $id => $vaccine) {
            $this->checkLength($vaccine, 200, $vaccine_name[$id]);
        }

        if (empty($this->Errors)) {
            $query = "INSERT INTO child_report(Name, Birthday, Guardian, GuardianId, RequestId, BirthPlace, Area, Centre, MidwifeEmail, NVD, BCG, Triple, Triple_Polio, MMR, Japanese_Encephalitis, Dual_Polio, Hepatitis_AB, Anti_Rabies, Chicken_Pox, Meningicoccal) VALUES('{$child_name}','{$birthday}','{$guardian}','{$guardian_id}','{$Request_id}','{$birth_place}','{$area}','{$center}','{$midwife_email}','{$NVD}', '{$vaccines[0]}', '{$vaccines[1]}','{$vaccines[2]}','{$vaccines[3]}','{$vaccines[4]}','{$vaccines[5]}','{$vaccines[6]}','{$vaccines[7]}','{$vaccines[8]}','{$vaccines[9]}')";
            if (empty($errors)) {
                $insert_query = mysqli_query($this->database->connect(), $query);

                if ($insert_query) {
                    header('Location:manager.php');
                } else {
                    $errors[] = 'Failed to Add a report';
                }
            }
        }
        return $this->Errors;
        //$requestObj->createReport();
    }
    public function createChildReport_Noreport($child_name, $birthday, $guardian, $guardian_id,$Request_id,$birth_place, $area, $center, $midwife_email, $NVD)
    {
        $vaccine_name = array("BCG Vaccine", "Triple Vaccine", "Triple/Polio Vaccine", "MMR Vaccine", "Japanese Encephalitis Vaccine", "Dual Polio Vaccine", "Hepatitis A, B Vaccine (there are separate vaccines for both A and B as well)", "Anti Rabies Vaccine", "Chicken Pox Vaccine", "Meningicoccal Vaccine");
        $req_fields = array($child_name, $birthday, $guardian, $guardian_id,$Request_id,$birth_place, $area, $center, $midwife_email, $NVD);
        $field_names = array("Name", "Birthday", "Guardian", "Guardian ID","Request Id", "Birth Place", "Area", "Centre", "Midwife email", "Next vaccination date");
        $this->check_req_fields($req_fields, $field_names);
        // print_r($vaccines);

        if (empty($this->Errors)) {
            $query = "INSERT INTO child_report(Name, Birthday, Guardian, GuardianId, RequestId, BirthPlace, Area, Centre, MidwifeEmail, NVD) VALUES('{$child_name}','{$birthday}','{$guardian}','{$guardian_id}','{$Request_id}','{$birth_place}','{$area}','{$center}','{$midwife_email}','{$NVD}')";
            if (empty($errors)) {
                $insert_query = mysqli_query($this->database->connect(), $query);

                if ($insert_query) {
                    header('Location:manager.php');
                } else {
                    $errors[] = 'Failed to Add a report';
                }
            }
        }
        return $this->Errors;
        //$requestObj->createReport();
    }

}
