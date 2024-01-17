<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMPLE LARAVEL 9 CRUD IN HINDI</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>

    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">SIMPLE LARAVEL 9 CRUD IN HINDI</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Employees</div>
            <div>
                <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{route('employees.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                     <div class="mb-3">
                         <label for="name" class="form-label">Name</label>
                         <input type="text" name="name" id="name" placeholder="enter name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                         @error('name')
                         <p class="invalid-feedback">{{$message}}</p>
                         @enderror
                     </div>

                     <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" placeholder="enter email" class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}">
                        @error('email')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="addresss" class="form-label">adderss</label>
                      <textarea name="address" id="address" cols="30" rows="4" placeholder="enter address" class="form-control" >{{old('address')}}</textarea>
                    </div>
                    <div class="mb-3">
                            <label for="image" class="form-label"></label>
                            <input type="file" name="image" class="@error('image') is-invalid @enderror">

                            @error('image')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary mt-3">Save Employee</button>
        </form>
    </div>


</body>

</html>
