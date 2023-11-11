<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Power GLobal - Event Registrar</title>
    <link rel="stylesheet" href="{{ url('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- Icons font CSS-->
    <link href="{{ url('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ url('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{ url('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ ('vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <style type="text/css">
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }

        .w-auto{
            width: auto;
        }
    </style>
</head>

<body>
    <div class="page-wrapper bg-white font-robo">
        <div class="wrapper wrapper--w680">
        	<img src="{{ url('images/mg_banner_final.jpg') }}" class="w-100">
            <div class="card card-1">
                <div class="card-body">
                    <h2 class="title">Online Event Registration</h2>
                    <form method="POST" action="/form" name="form">
                        @csrf
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="NAME" name="name" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="email" placeholder="E-MAIL (OPTIONAL)" name="email">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="number" placeholder="PHONE" name="phone" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="COMPANY" name="company" required>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2 text-grey">
                                <h5 style="margin-top: 8px;">INTERESTS <span style="color: #CE2029;">*</span></h5>
                                <br>
                                <div class="form-check" style="margin-bottom: 15px;">
                                    <input class="w-auto form-check-input" type="checkbox" name="pos[]" value="Clothings" id="pos1">
                                    <label class="form-check-label" for="pos1">
                                        Clothings
                                    </label>
                                </div>
                                <div class="form-check" style="margin-bottom: 15px;">
                                    <input class="w-auto form-check-input" type="checkbox" name="pos[]" value="Fabrics and Accessories" id="pos2">
                                    <label class="form-check-label" for="pos2">
                                        Fabrics and Accessories
                                    </label>
                                </div>
                                <div class="form-check" style="margin-bottom: 15px;">
                                    <input class="w-auto form-check-input" type="checkbox" name="pos[]" value="Machinery" id="pos3">
                                    <label class="form-check-label" for="pos3">
                                        Machinery
                                    </label>
                                </div>
                                <div class="form-check" style="margin-bottom: 15px;">
                                    <input class="w-auto form-check-input" type="checkbox" name="pos[]" value="Bags" id="pos4">
                                    <label class="form-check-label" for="pos4">
                                        Bags
                                    </label>
                                </div>
                                <div class="form-check" style="margin-bottom: 15px;">
                                    <input class="w-auto form-check-input" type="checkbox" name="pos[]" value="Shoes" id="pos5">
                                    <label class="form-check-label" for="pos5">
                                        Shoes
                                    </label>
                                </div>
                                <div class="form-check" style="margin-bottom: 15px;">
                                    <input class="w-auto form-check-input" type="checkbox" name="pos[]" value="Others" id="pos6">
                                    <label class="form-check-label" for="pos6">
                                        Others
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" id="checkBtn">Submit</button>
                            <!-- <div class="btn btn--radius btn--green" id="checkBtn"> -->
                                <!-- Submit -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- Vendor JS-->
    <script src="{{ url('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ url('vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ url('vendor/datepicker/daterangepicker.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ url('js/global.js') }}"></script>
    <script type="text/javascript">
        // Turn off the value scrolling behaviour on all fields
        document.addEventListener("wheel", function(event){
            if(document.activeElement.type === "number"){
                document.activeElement.blur();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#checkBtn').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if(!checked) {
                    alert("You must select at least one interest.");
                    return false;
                }
            });
        });
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
