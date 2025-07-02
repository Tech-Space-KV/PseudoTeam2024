<nav class="navbar navbar-expand-lg navbar-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand ms-2 text-primary" onclick="showleftbar()">
            <span class="navbar-toggler-icon"></span>
        </a>
        <div class="mx-auto w-75">
            <form class="d-flex" action="/customer/session/search_project" method="GET">
                <input class="form-control form-control-sm me-2 rounded-pill" type="search" name="query"
                    placeholder="Search project id or title" value="{{ request('query') }}" 
                    aria-label="Search">
                <button class="btn btn-sm btn-outline-primary rounded-pill" type="submit">
                    Search
                </button>
            </form>

        </div>

        <a class="navbar-brand ms-2 text-primary">
            <span class="navbar-toggler-icon"></span>
        </a>
    </div>
</nav>