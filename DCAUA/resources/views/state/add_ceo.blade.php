<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add CEO/PD Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">

</head>

<body>
    <div class="d-flex justify-content-center">
        <form id="add_ceo_form" class="col-md-5 mt-5 bg-white shadow p-5 rounded">
            @csrf
            <h3 class="col text-center bg-primary rounded text-white">ADD CEO/PD LOGIN !</h3>
            <div class="d-flex col flex-column mb-3">
                <label for="exampleInputEmail1" class="form-label col">Login As</label>
                <select name="district_id" id="" class="form-select col">
                    <option value="" selected disabled>Select</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter Employe Name </label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter Phone Number</label>
                <input type="number" name="phone" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter Email ID</label>
                <input type="email" name="email" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enter Employe Designation</label>
                <input type="text" name="designation" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="d-flex justify-content-center pt-3">
                <button type="submit" id="add_ceo_btn" class="btn btn-primary">ADD USER</button>
            </div>
        </form>
    </div>
    <script script script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/state/add_ceo.js') }}"></script>
</body>

</html>
