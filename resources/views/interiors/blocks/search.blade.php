<div class="search-wrapper section-padding-100">
    <div class="search-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="search-content">
                    <form action="{{ route('search_interior_client') }}" method="get">
                        <input type="search" name="search" id="search" placeholder="Tìm kiếm tại đây" class="inte_search">
                        <button type="submit"><img src="{{ asset('interior/img/core-img/search.png') }}" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>