<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>{{ date('Y') }} &copy; </p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                    href="https://github.com/ademalkan">Adem</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>


<script src="{{ asset('assets/js/mazer.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
@yield("js")

</body>

</html>
