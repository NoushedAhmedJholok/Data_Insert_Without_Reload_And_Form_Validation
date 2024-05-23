<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Laravel Data Insert Without Reload And Form validation
![image](https://github.com/NoushedAhmedJholok/Data_Insert_Without_Reload_And_Form_Validation/assets/80415299/647d3c55-19bd-4ef0-84d5-8308676c33ef)


### Here Blade / HTML Form 
```language
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
```
### Here Blade / HTML JS Code 
```language
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

```

### Controller Code 
```language
 public function insert(Request $request)
    
    {

        try {
             $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:user_data,email',
                'phone' => 'required|unique:user_data,phone|max:11|min:11',
            ]);
    
            // Insert user data into the database
            UserData::insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => 'image.png', // Assuming image is provided in the request
            ]);
            // Return success response
        return response()->json(['message' => 'Data inserted successfully']);
    } catch (ValidationException $e) {
        // Check if the error is due to duplicate email
        if ($e->validator->errors()->has('email')) {
            return response()->json(['error' => 'The email has already been taken.'], 422);
        }

        // Return other validation errors
        return response()->json(['errors' => $e->validator->errors()->all()], 422);
    } catch (\Exception $e) {
        // Log the error for further investigation
        \Log::error('Error inserting data: ' . $e->getMessage());

        // Return error response
        return response()->json(['error' => 'An error occurred while inserting data. Please try again.'], 500);
    }
        
    }
```
### Route ( Web.php )

```language
Route::post('/insert', [InputController::class, 'insert'])->name('insert');
```

## Hope this code will be useful for you.
## Let's be friends [LinkedIn](https://www.linkedin.com/in/noushedahmedjholok/) & [Facebook](https://www.facebook.com/NoushedAhmedJholok)
