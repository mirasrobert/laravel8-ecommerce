<!-- Create Product Modal-->
<div
    class="modal fade"
    id="editProductModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button
                    class="close"
                    type="button"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" role="form" data-toggle="validator" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="eg. Camera, Bag"
                               value=""/>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price"
                               placeholder="eg. $99.00" value=""/>
                    </div>

                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" name="qty" id="qty"
                               placeholder="eg. 50" value=""/>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="title">Image</label>
                        </div>
                        <div class="file-upload mb-3">
                            <input class="file-upload__input" type="file" name="image[]" id="image" multiple
                                   accept="image/png, image/jpeg, image/gif">
                            <button class="file-upload__button" type="button">Choose File(s)</button>
                            <span class="file-upload__label"></span>
                        </div>
                        <div class="img-preview d-flex">

                        </div>
                        <div id="image-err" class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control" name="brand" id="brand"
                               placeholder="eg. ASUS, Acer" value=""/>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category"
                               placeholder="eg. Electronic, Accessories" value=""/>
                    </div>


                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control form-control-textarea" name="description" id="description"
                                  placeholder="eg. Specify what product are you selling..." rows="4"></textarea>
                    </div>

                    <div class="mt-2">
                        <hr>
                    </div>
                    <div class="form-footer d-flex justify-content-end">
                        <button
                            id="cancel"
                            class="btn btn-danger"
                            type="button"
                            data-dismiss="modal">
                            Cancel
                        </button>
                        <button class="ml-2 btn btn-primary" id="submit">
                            <img id="loader" src="{{ asset('img/loading.gif') }}" width="25" height="25"
                                 class="img-fluid"
                                 alt="loader">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
