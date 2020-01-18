<script id="dichvu-row-template" type="text/x-lodash-template">
<div class="row border-bottom mt-4" id="dynamic-row-<%= index %>">
    <div class="col col-md-3 text-center">
        <div class="kv-avatar text-center">
            <div class="file-loading">
                @if(empty($dichvu->anhdaidien))
                <input id="dichvu-anhdaidien-file-<%= index %>" name="dichvu_anhdaidien_file[]" type="file" required>
                @else
                <input id="dichvu-anhdaidien-file-<%= index %>" name="dichvu_anhdaidien_file[]" type="file">
                @endif
            </div>
        </div>
        <div class="kv-avatar-hint"><small>Select file < 1500 KB</small></div>
        <div id="kv-avatar-errors-dichvu-anhdaidien-file" class="center-block" style="display:none"></div>
    </div><!-- col -->
    <div class="col">
        <div class="form-group row">
            <div class="col">
                <input type="text" name="dichvu_tendichvu[]" id="dichvu-tendichvu-<%= index %>" placeholder="Tên dịch vụ" class="form-control" value="<%= tendichvu %>" />
            </div><!--col-->
            <div class="col">
                <input type="text" name="dichvu_motangan[]" id="dichvu-motangan-<%= index %>" placeholder="Mô tả ngắn" class="form-control" value="<%= motangan %>" />
            </div><!--col-->
            <div class="col">
                <input type="number" name="dichvu_gia[]" id="dichvu-gia-<%= index %>" placeholder="Giá" cleave-auto-unmask="true" class="form-control input-element-number" value="<%= gia %>" />
            </div><!--col-->
            <div class="col col-md-auto">
                <button type="button" name="remove" id="<%= index %>" class="btn btn-danger btn_remove">X</button>
            </div>
        </div><!--form-group-->

        <div class="form-group row">
            <div class="col">
                <input type="text" name="dichvu_gioithieu[]" id="dichvu-gioithieu-<%= index %>" placeholder="Giới thiệu" class="form-control" value="<%= gioithieu %>" />
            </div><!--col-->
        </div><!--form-group-->
    </div><!-- col -->
</div><!-- row -->
</script>