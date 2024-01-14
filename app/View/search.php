<?php if (!empty($results)): ?>
<?php foreach ($results as $wiki): ?>
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
<div class="alert alert-info" role="alert">
    No wikis found.
</div>
<?php endif; ?>