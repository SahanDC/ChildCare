<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <title>Hello, world!</title>
    <title>Document</title>
</head>
<body>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  -->



<!--header start-->
  <header>
  
    <div class="px-3 py-2 bg-dark text-white"><h3>Harshani Bandara</h3>
      <div class="container">
        
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
          </a>
          
          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="manager.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                Home
              </a>
            </li>
            <li>
              <a href="health advices.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                Helth Advices
              </a>
            </li>
            <li>
              <a href="child report.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                 Child Reports
              </a>
            </li>
            <li>
              <a href="requests.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                Child Report Request
              </a>
            </li>
            <li>
              <a href="area details.php" class="nav-link text-secondary">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                Area details
              </a>
            </li>
            <li>
              <a href="profile.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
                Profile
              </a>
            </li>
            <li>
            <div class="text-end"><a href="main.html" class="nav-link text-white"></a>
                
                <button type="button" class="btn btn-primary"><a class="nav-link" href="./controllers/logout.php">Log out</a></button></div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  
  </header>
<!--header finish-->
<!--grid start-->
<!--header finish-->
<div class="container">
  <h2 class="mt-4">Area Details</h2>
  <p>There are five tiers to the Bootstrap grid system, one for each range of devices we support. Each tier starts at a minimum viewport size and automatically applies to the larger devices unless overridden.</p>
  
  <div class="row mb-3">
    <div class="col-4 themed-grid-col">AREA</div>
    <div class="col-4 themed-grid-col">NUMBER OF FAMILIES</div>
    <div class="col-4 themed-grid-col">NUMBER OF CHILDRENS</div>
  </div>
  
  <div class="row mb-3">
    <div class="col-4 themed-grid-col">area 1</div>
    <div class="col-4 themed-grid-col">32</div>
    <div class="col-4 themed-grid-col">120</div>
  </div>
  
  <div class="row mb-3">
    <div class="col-4 themed-grid-col">area 1</div>
      <div class="col-4 themed-grid-col">32</div>
      <div class="col-4 themed-grid-col">120</div>
  </div>
  
  <div class="row mb-3">
    <div class="col-4 themed-grid-col">area 1</div>
      <div class="col-4 themed-grid-col">32</div>
      <div class="col-4 themed-grid-col">120</div>
  </div>
  
  <div class="row mb-3">
    <div class="col-4 themed-grid-col">area 1</div>
      <div class="col-4 themed-grid-col">32</div>
      <div class="col-4 themed-grid-col">120</div>
  </div>
  </div>
  <!--first table finish************************************************************************************************-->
  


<!--footer**************************************************************************************************************-->
  <div class="container" >
    <footer class="py-5">
      <div class="row">
        <div class="col-2">
          <h5>Section</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
          </ul>
        </div>
  

  
        
  
      <div class="d-flex justify-content-between py-4 my-4 border-top">
        <p>&copy; 2021 Company, Inc. All rights reserved.</p>
        <ul class="list-unstyled d-flex">
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
        </ul>
      </div>
    </footer>
  </div>
</body>
</html>