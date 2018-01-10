<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd">
            <div class="panel-heading p-0"></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text"
                                       name="search_user"
                                       class="form-control"
                                       value="{{ $searchInput or '' }}"
                                       autocomplete="off"
                                       placeholder="{{ trans('content.users.search.placeholder') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="submit">
                                        <span class="ti-search"></span>
                                        {{ trans('content.users.search.button') }}
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>