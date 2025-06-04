<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            , {{ env('APP_NAME') }}
            <p class="footer-link fw-bolder">Nan</p>
        </div>
        <div>
            
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script>
    document.getElementById('logout-button').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out from this session.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log me out!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('vendor') }}/libs/jquery/jquery.js"></script>
<script src="{{ asset('vendor') }}/libs/popper/popper.js"></script>
<script src="{{ asset('vendor') }}/js/bootstrap.js"></script>
<script src="{{ asset('vendor') }}/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ asset('vendor') }}/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('vendor') }}/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="{{ asset('js') }}/main.js"></script>

<!-- Page JS -->
{{-- <script src="{{ asset('js') }}/dashboards-analytics.js"></script> --}}

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
@stack('scripts')
</body>

</html>
