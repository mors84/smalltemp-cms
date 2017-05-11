{{-- Modal --}}
<div class="modal fade" id="modalAddTag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{trans('admin.close')}}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin.addTag')}}</h4>
            </div>
            <div class="modal-body m-t-xl m-b-xl">

                <form accept-charset="UTF-8" class="form-horizontal">

                    {{-- Tag Name --}}
                    <div class="form-group {{$errors->has('name') ? 'has-error' : null}}">
                        <label for="name" class="col-sm-4 control-label">{{trans('tables.name')}}&nbsp;*</label>

                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" name="name" value="{{old('name')}}" required id="name" class="form-control">
                                <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.tagInfo')}}"><i class="fa fa-question-circle"></i></span>
                            </div>
                            <span id="error-name" class="text-danger"></span>
                        </div>
                    </div>

                    {{-- Metadata --}}
                    <fieldset class="m-t-xl">
                        <legend>{{trans('tables.metadata')}}</legend>
                        <p class="m-b-lg">{{trans('admin.metadataInfo')}}</p>

                        {{-- Metadata Title --}}
                        <div class="form-group {{$errors->has('metadata_title') ? 'has-error' : null}}">
                            <label for="metadata_title" class="col-sm-4 control-label">{{trans('tables.metaTagTitle')}}</label>

                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="metadata_title" value="{{old('metadata_title')}}" id="metadata_title" class="form-control">
                                    <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.metaTagTitleInfo')}}"><i class="fa fa-question-circle"></i></span>
                                </div>
                                <span id="error-metadata-title" class="text-danger"></span>
                            </div>
                        </div>

                        {{-- Metadata Keywords --}}
                        <div class="form-group {{$errors->has('metadata_keywords') ? 'has-error' : null}}">
                            <label for="metadata_keywords" class="col-sm-4 control-label">{{trans('tables.metaTagKeywords')}}</label>

                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" name="metadata_keywords" value="{{old('metadata_keywords')}}" id="metadata_keywords" class="form-control">
                                    <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.metaTagKeywordsInfo')}}"><i class="fa fa-question-circle"></i></span>
                                </div>
                                <span id="error-metadata-keywords" class="text-danger"></span>
                            </div>
                        </div>

                        {{-- Metadata Description --}}
                        <div class="form-group {{$errors->has('metadata_description') ? 'has-error' : null}}">
                            <label for="metadata_description" class="col-sm-4 control-label">{{trans('tables.metaTagDescription')}}</label>

                            <div class="col-sm-8">
                                <div class="input-group">
                                    <textarea name="metadata_description" rows="5" cols="80" id="metadata_description" class="form-control">{{old('metadata_description')}}</textarea>
                                    <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.metaTagDescriptionInfo')}}"><i class="fa fa-question-circle"></i></span>
                                </div>
                                <span id="error-metadata-description" class="text-danger"></span>
                            </div>
                        </div>

                    </fieldset>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin.close')}}</button>
                <button type="button" id="buttonAddTag" class="btn btn-primary"><i class="fa fa-plus m-r-xs"></i>{{trans('admin.add')}}</button>
            </div>
        </div>
    </div>
</div>
