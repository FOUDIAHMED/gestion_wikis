<?php
$title = "HomePage";
ob_start();
?>

<div class="jumbotron color-black py-5 text-center mdb-color darken-2 position-relative p-0 m-0 "
    >

    <!-- Opacity Overlay -->
    <div class="position-absolute w-100 h-100 bg-dark top-0" style="opacity: 0.7;"></div>

    <div class="container position-relative">
        <h1 class="display-4 text-white">Welcome to Wiki</h1>
        <p class="lead text-white">Your go-to platform for collaborative knowledge sharing.</p>
        <div class="d-flex justify-content-center">
            <div class="input-group mb-3 w-75 py-3">
                <input type="search" class="form-control" id="datatable-search-input"
                    placeholder="Search for wikis, categories, tags...">
            </div>
        </div>
    </div>
</div>


<div class="container">
<div class="p-5">
    <div class="row"  id="live-search-results">
        <div class="col-lg-9">
            <div class="container py-5">
                <h2 class="mb-4">Nouveaux articles</h2>
                <div class="container my-5">
    <div class="row">
        <?php if (!empty($latestWikis)): ?>
            <?php foreach ($latestWikis as $wiki): ?>
                <div class="col-md-12 mb-4">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                                            <?php echo $wiki->getTitle(); ?>
                                        </a>
                                    </h3>
                                    <p class="card-text">
                                        <?php
                                        $content = $wiki->getContent();
                                        echo substr($content, 0, 100) . '...';
                                        ?>
                                    </p>
                                    <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                            <?php if ($wiki->getImg()): ?>
                                <div class="col-md-6">
                                    <img src="<?php echo $wiki->getImg(); ?>" class="img-fluid" alt="Wiki Image">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No wikis found.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

        
            </div>
        </div>

        <div class="col-lg-3">
            <div class="container">
                <h2>Latest Wikis</h2>
                <div class="card h-100">
                    <?php foreach ($latestWikis as $wiki): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="index.php?action=wiki&id=<?php echo $wiki->getId(); ?>">
                                    <?php echo $wiki->getTitle(); ?>
                                </a>
                            </h5>
                            <p class="card-text">
                                <?php
                                    $content = $wiki->getContent();
                                    echo substr($content, 0, 50);
                                    if (strlen($content) > 100) {
                                        echo '...';
                                    }
                                    ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>


            
        </div>
    </div>
</div>
<div class="col-lg-3">

                <h2>Latest Categories</h2>
                <div class="card h-100">
                    <?php foreach ($latestCategories as $category): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="index.php?action=category&id=<?php echo $category->getId(); ?>">
                                    <?php echo $category->getName(); ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            
</div>
</div>

<!-- Footer -->
<footer class="footer py-5">
    <p class="text-center text-black">&copy; 2024 WikiInfo. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $('#datatable-search-input').on('input', function() {
        var query = $(this).val();

        $.get('index.php?action=liveSearch&query=' + query, function(data) {
            $('#live-search-results').html(data);
        });

    });
});
$.get('index.php?action=liveSearch&query=0', function(data) {
    $('#live-search-results').html(data);
});
</script>
<?php $content = ob_get_clean(); ?>
<?php include_once 'app/views/include/layout.php'; ?>