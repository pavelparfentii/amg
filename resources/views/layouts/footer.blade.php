<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            © <script>document.write(new Date().getFullYear())</script>
            , made with ❤️ by DoSolution
        </div>
        <div  class="d-none d-lg-inline-block">
        </div>
    </div>
</footer>

<div class="content-backdrop fade"></div>
</div>
<!--/ Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>



<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('js/hammer.js') }}"></script>
<script src="{{ asset('js/typeahead.js') }}"></script>
<script src="{{ asset('js/menu.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/nouislider.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('js/ui-popover.js') }}"></script>
<!--<script src="{{ asset('js/forms-sliders.js') }}"></script>-->
<script src="/vendor/datatables/datatables.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
       $(".menu-item").click(function(){
           $(".menu-item").removeClass('open');
           $(this).toggleClass('open');
       });
       $(".layout-menu-toggle").click(function(){
          $('html').toggleClass('layout-menu-collapsed');
       });
       $('#flatpickr-date').on('change', function(){
          var date = $(this).val();

          $.ajax({
             type: "POST",
              url: "{{ route('site.date_refresh') }}",
             data: {'_token': '{{ csrf_token() }}', 'date': date},
             cache: false,
             success: function(response){
                 window.open("{{ route('site.index') }}", "_self");
             }
          });
       });
        $("#list").DataTable({
            paging: true,
            responsive: false,
            lengthMenu: [10, 50, 100, 200, 9999],
            pageLength: 50,
            order: [[0, 'asc']],
            scrollX: 400,
            language: {
                url: "/js/ua.json",
            }
        });
    });
</script>

