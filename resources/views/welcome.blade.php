<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Validation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><h3 class="text-light">Form Validation</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card mt-5">
                    <div class="card-header bg-dark text-success">
                        <h3>All Input Validation</h3>
                    </div>
                    <div class="card-body bg-dark text-white">
                        <form  id="insertForm">
                            @csrf
                            <h2>User Profile</h2>
                            <div class="form-group">
                                <label for="email">Full Name:</label>
                                <div class="relative">
                                    <input name="name" class="form-control" id="name" type="text" placeholder="Type your name here...">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <div class="relative">
                                    <input name="email" class="form-control" type="email" placeholder="Type your email address...">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Contact Number:</label>
                                <div class="relative">
                                    <input name="phone" class="form-control" type="text" placeholder="Type your Mobile Number...">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                              
                                            
                            <div class="tright">
                                <a href=""><button class="movebtn movebtnre btn btn-success" type="Reset"><i class="fa fa-fw fa-refresh "></i> Reset </button></a>
                                <a href=""><button class="movebtn movebtnsu btn btn-success" type="Submit" id="submitBtn">Submit <i class="fa fa-fw fa-paper-plane"></i></button></a>
                            </div>
                          </form>
                          <div id="responseMessage"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default form submission
            
            // Clear previous response message
            document.getElementById('responseMessage').innerText = '';
        
            // Collect form data
            var formData = new FormData(document.getElementById('insertForm'));
        
            // Send AJAX request
            fetch('/insert', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Check if the response contains validation errors
                if (data.errors) {
                    // Display validation errors
                    data.errors.forEach(error => {
                        document.getElementById('responseMessage').innerHTML += '<p>' + error + '</p>';
                    });
                } else if (data.error) {
                    // Display server error message
                    document.getElementById('responseMessage').innerText = data.error;
                } else {
                    // Handle success response
                    document.getElementById('responseMessage').innerText = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('responseMessage').innerText = 'An error occurred. Please try again.';
            });
        });
        </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>