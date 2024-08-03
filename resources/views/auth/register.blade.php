<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('libs/angular.min.js') }}"></script>
    <script src="{{ asset('libs/app.js') }}"></script>
</head>

<body ng-controller="registerController">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Đăng ký</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="mb-3 container">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tên</label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng ký </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>