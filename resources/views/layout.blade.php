<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant System</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="{{asset('css/sideBar.css')}}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body>

        <div class="side-bar">
            <h2>Restaurant Name</h2>
            <div class="menu">
                <div class="item"><a href="Home.php">Dashboard</a></div>
                <div class="item"><a href="#">Access Control (RBAC)</a></div>
                <div class="item"><a href="/staff">Staff</a></div>
                <div class="item">
                    <a class="sub-btn" href="/product">Product</a>
                </div>
                <div class="item">
                    <a class="sub-btn">Order<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="/orders/add" class="sub-item">Add New Order</a>
                        <a href="/order" class="sub-item">Edit Order Details</a>
                        <a href="#" class="sub-item">Cancel Order</a>
                    </div>
                </div>
                <div class="item"><a href="#">Payment</a></div>
                <div class="item"><a href="">Voucher</a></div>
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

    <script type="text/javascript">



        $(document).ready(function () {
            //jquery for toggle sub menus
            $('.sub-btn').click(function () {
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');
            });
        });

        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this product?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                            $this.closest('tr').fadeOut(500, function () {
                                $(this).remove();
                            })
                        })
                    }
                })
            })
        })


        document.getElementById('generateCode').onchange = function () {
            document.getElementById('code').disabled = this.checked;
            document.getElementById('code').Required = !this.checked;
        }

    </script>
    @yield('scripts')

    </body>
</html>
