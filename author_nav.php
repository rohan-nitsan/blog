<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <h1 class="navbar-brand">Welcome</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>

            </ul>
            <form class="d-flex navbar-nav me-auto mb-2 mb-lg-0">
                <input class="form-control me-2" type="search" id="searchbar" placeholder="Search" aria-label="Search">
                <input id="searchbar" onkeyup="search_data()" type="text" name="search" placeholder="Search...">
            </form>
            <?php
            if ($_SERVER['PHP_SELF'] == "/blog/index.php") {
            ?>
                <a href="logout.php"><button class="btn btn-danger">Logout</button></a>
            <?php } else {
            ?>
                <a href="../logout.php"><button class="btn btn-danger">Logout</button></a>
            <?php } ?>
        </div>
    </div>
</nav>
<script>
    function search_data() {
        let input = document.getElementById('searchbar').value
        input = input.toLowerCase();
        let x = document.getElementsByClassName('card');

        for (i = 0; i < x.length; i++) {
            if (!x[i].innerHTML.toLowerCase().includes(input)) {
                x[i].style.display = "none";
            } else {
                x[i].style.display = "list-item";
            }
        }
    }
</script>