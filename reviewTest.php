<div class="col-md-10 mt-3 mx-5 justify-content-center">
            <div class="card">
                <div class="card-header">
                    Leave a reply
                </div>
                <div class="card-body">
                    <form action="<?= base_url('reply') ?>" method="POST">
                        <input type="hidden" name="user_id" value="">
                        <div class="mb-3">
                            <textarea name="content" class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" name="reply" value="Post A Reply" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
