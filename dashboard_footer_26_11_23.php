 <!-- Modal Add New Post Start-->
    <div class="modal fade" id="addNewPostModal" tabindex="-1" aria-labelledby="addNewPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content dark-blue-bg">
                <div class="modal-header border-0 p-4 pb-md-0">
                    <button type="button" class="btn-close white-bg" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="row g-2">
                        <div class="col-md-12">
                            <textarea name="" id="" cols="30" rows="1" class="form-control shadow-none border-0" placeholder="Type the title for your post..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-control py-2">
                                        <input type="file" id="inputGroupFile" class="form-control shadow-none border-0 my-1">
                                        <img src="" id="imgPreview" class="img-fluid d-grid rounded-2" alt="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea name="" id="" cols="30" rows="4" class="form-control shadow-none border-0" placeholder="Type something..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <textarea name="" id="" cols="30" rows="4" class="form-control shadow-none border-0 h-100" placeholder="Type the description for your post..."></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn border btn-typ4 px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn border btn-typ4 px-4 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add New Post End-->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    </script>
    <script>
        /****************Image Preview****************/
        inputGroupFile.onchange = evt => {
        const [file] = inputGroupFile.files
            if (file) {
                imgPreview.src = URL.createObjectURL(file)
            }
        }
        /*********************End*********************/
         function myfunction(){
        window.location.href = "logout.php";
    }
    </script>
</body>

</html>