<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant System</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="{{asset('css/sideBar.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

    </head>
{{--    <style>--}}
{{--        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');--}}

{{--        *{--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            box-sizing: border-box;--}}
{{--            font-family: "Poppins", sans-serif;--}}
{{--        }--}}

{{--        body{--}}
{{--            min-height: 100vh;--}}
{{--            background: no-repeat;--}}
{{--            background-size: cover;--}}
{{--            background-position: center;--}}
{{--        }--}}

{{--        .side-bar{--}}
{{--            background-color: #e6e6e6;--}}
{{--            backdrop-filter: blur(15px);--}}
{{--            width: 290px;--}}
{{--            height: 100vh;--}}
{{--            position: fixed;--}}
{{--            top: 0;--}}
{{--            overflow-y: auto;--}}
{{--            transition: 0.6s ease;--}}
{{--            transition-property: left;--}}
{{--        }--}}

{{--        .side-bar.active{--}}
{{--            left: 0;--}}
{{--        }--}}

{{--        .side-bar h2{--}}
{{--            margin: 20px 20px 20px 20px;--}}
{{--        }--}}

{{--        .side-bar .menu{--}}
{{--            width: 100%;--}}
{{--            margin-top: 10px;--}}
{{--        }--}}

{{--        .side-bar .menu .item{--}}
{{--            position: relative;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .side-bar .menu .item a{--}}
{{--            color: #000000;--}}
{{--            font-size: 16px;--}}
{{--            text-decoration: none;--}}
{{--            display: block;--}}
{{--            padding: 5px 30px;--}}
{{--            line-height: 60px;--}}
{{--        }--}}

{{--        .side-bar .menu .item a:hover{--}}
{{--            background: #8621F8;--}}
{{--            transition: 0.3s ease;--}}
{{--        }--}}

{{--        .side-bar .menu .item i{--}}
{{--            margin-right: 15px;--}}
{{--        }--}}

{{--        .side-bar .menu .item a .dropdown{--}}
{{--            position: absolute;--}}
{{--            right: 0;--}}
{{--            margin: 20px;--}}
{{--            transition: 0.3s ease;--}}
{{--        }--}}

{{--        .side-bar .menu .item .sub-menu{--}}
{{--            background-color: #ffffff;--}}
{{--            display: none;--}}
{{--        }--}}

{{--        .side-bar .menu .item .sub-menu a{--}}
{{--            padding-left: 80px;--}}
{{--        }--}}

{{--        .rotate{--}}
{{--            transform: rotate(90deg);--}}
{{--        }--}}

{{--        @media (max-width: 900px){--}}
{{--            .main h1{--}}
{{--                font-size: 40px;--}}
{{--                line-height: 60px;--}}
{{--            }--}}
{{--        }--}}

{{--            .error{color: red;}--}}

{{--    .upper-section{--}}
{{--        margin-left: 320px;--}}
{{--        margin-right: 50px;--}}
{{--    }--}}

{{--    .upper-section h2{--}}
{{--        margin-top: 30px;--}}
{{--        margin-bottom: 20px;--}}
{{--    }--}}

{{--    .lower-section{--}}
{{--        margin-left: 320px;--}}
{{--        margin-right: 50px;--}}
{{--        margin-bottom: 70px;--}}
{{--    }--}}

{{--    .lower-section h2{--}}
{{--        margin-top: 30px;--}}
{{--        margin-bottom: 20px;--}}
{{--    }--}}

{{--    table {--}}
{{--        margin-left: 10px;--}}
{{--        font-family: arial, sans-serif;--}}
{{--        border-collapse: collapse;--}}
{{--        width: 100%;--}}
{{--    }--}}

{{--    td, th {--}}
{{--        border: 1px solid #dddddd;--}}
{{--        text-align: left;--}}
{{--        padding: 8px;--}}
{{--    }--}}

{{--    tr:nth-child(even) {--}}
{{--        background-color: #dddddd;--}}
{{--    }--}}
{{--    </style>--}}
    <body>

        <div class="side-bar">
            <h2>Restaurant Name</h2>
            <div class="menu">
                <div class="item"><a href="Home.php">Dashboard</a></div>
                <div class="item"><a href="#">Access Control (RBAC)</a></div>
                <div class="item"><a href="/staff">Staff</a></div>
                <div class="item">
                    <a class="sub-btn">Product<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="#" class="sub-item">Add New Product</a>
                        <a href="#" class="sub-item">Edit Product Info</a>
                        <a href="#" class="sub-item">Remove Product</a>
                    </div>
                </div>
                <div class="item">
                    <a class="sub-btn">Order<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="#" class="sub-item">Add New Order</a>
                        <a href="#" class="sub-item">Edit Order Details</a>
                        <a href="#" class="sub-item">Cancel Order</a>
                    </div>
                </div>
                <div class="item"><a href="#">Payment</a></div>
                <div class="item"><a href="#">Voucher</a></div>
                <div class="item"><a href="/restauranttable">Table</a></div>
                <div class="item"><a href="/reservation">Reservation</a></div>
                <div class="item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
        <div>
            @yield('content')
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            //jquery for toggle sub menus
            $('.sub-btn').click(function () {
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
            });
        });
    </script>
</html>
