<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
</head>

<body> 
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="mb-3">Contact Us</h1>
                <form action="{{ route('contacts.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')  
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="your-name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="your-name" name="name" value={{ $data->name }} >
                        </div>
                        <div class="col-md-6">
                            <label for="your-surname" class="form-label">Your Surname</label>
                            <input type="text" class="form-control" id="your-surname" name="surname" value={{ $data->surname }} >
                        </div>
                        <div class="col-md-8">
                            <label for="your-email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="your-email" name="email" value={{ $data->email }} >
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile No.</label>

                            <input type="text" name="mobile" id="mobile" class="form-control" maxlength="10"
                                placeholder="Enter 10 digit mobile number" value={{ $data->mobile }} >
                        </div>

                        <div>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter password" value={{ $data->password }} >
                        </div>

                        <div class="mb-3">
                            <label for="profile_pic" class="form-label">Profile Picture</label>

                            <input type="file" name="profile_pic" id="profile_pic" class="form-control"
                                accept=".jpg,.jpeg,.png" value="{{ $data->profile_pic }}"> 

                        </div>

                        <div class="col-12 mt-3">

                            <div class="row">

                                <div class="col-md-6 mt-3">

                                    <button type="submit" class="btn btn-dark w-100 fw-bold">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>