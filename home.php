<?php
include 'admin/db_connect.php';
?>

<?php
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
?>
<main>
    <section class="course section" id="lelang">
        <div class="background-bg">
            <div class="overlay overlay-sm">
                <img src="./images/shapes/half-circle.png" class="shape half-circle1" alt="" />
                <img src="./images/shapes/half-circle.png" class="shape half-circle2" alt="" />
                <img src="./images/shapes/square.png" class="shape square" alt="" />
                <img src="./images/shapes/wave.png" class="shape wave" alt="" />
                <img src="./images/shapes/circle.png" class="shape circle" alt="" />
                <img src="./images/shapes/triangle.png" class="shape triangle" alt="" />
                <img src="./images/shapes/x.png" class="shape xshape" alt="" />
            </div>
        </div>

        <div class="container">
            <div class="section-header">
                <h3 class="title" data-title="Anggi">Lelang</h3>
            </div>

            <div class="section-body">
                <div class="filter">
                    <button class="filter-btn active" data-filter="*">All</button>
                    <?php
                    $cat = $conn->query("SELECT * FROM categories ORDER BY name asc");
                    while ($row = $cat->fetch_assoc()) :
                        $cat_arr[$row['id']] = $row['name'];
                    ?>
                        <button class="filter-btn" data-filter=".<?= strtolower(str_replace(' ', '', $row['name'])) ?>"><?= $row['name'] ?></button>
                    <?php endwhile; ?>
                </div>

                <div class="grid">
                    <?php
                    $where = "";
                    if ($cid > 0) {
                        $where  = " and category_id =$cid ";
                    }
                    $cat = $conn->query("SELECT * FROM products where unix_timestamp(bid_end_datetime) >= " . strtotime(date("Y-m-d H:i")) . " $where ORDER BY name asc");
                    if ($cat->num_rows <= 0) {
                        echo "<center><h4><i>No Available Product.</i></h4></center>";
                    }
                    while ($row = $cat->fetch_assoc()) :
                    ?>
                        <div class="grid-item <?= strtolower(str_replace(' ', '', $cat_arr[$row['category_id']])) ?>" data-id="<?= $row['id'] ?>">
                            <div class="gallery-image">
                                <div class="news-image">
                                    <img src="admin/assets/uploads/<?= $row['img_fname'] ?>" alt="intro-to-coding" />
                                </div>
                                <div class="news-content">
                                    <div class="news-info">
                                        <h5 class="news-date"><?= date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></h5>
                                        <h5 class="news-user">RP. <?= number_format($row['harga_awal']) ?><i class="fas fa-tag"></i></h5>
                                    </div>
                                    <h3 class="title-sm"><?= $row['name'] ?></h3>
                                    <p class="news-text">
                                        <?= $row['description'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
    <div class="wave">
        <img src="images/illust/wave.png" alt="">
    </div>
    <section class="review-section section" id="reviews">
        <div class="background-bg">
            <div class="overlay overlay-sm">
                <img src="./images/shapes/half-circle.png" class="shape half-circle1" alt="" />
                <img src="./images/shapes/half-circle.png" class="shape half-circle2" alt="" />
                <img src="./images/shapes/square.png" class="shape square" alt="" />
                <img src="./images/shapes/wave.png" class="shape wave" alt="" />
                <img src="./images/shapes/circle.png" class="shape circle" alt="" />
                <img src="./images/shapes/triangle.png" class="shape triangle" alt="" />
                <img src="./images/shapes/x.png" class="shape xshape" alt="" />
            </div>
        </div>

        <div class="container">
            <div class="section-header">
                <h3 class="title" data-title="Anggi">Reviews</h3>
            </div>
            <div class="section-body">
                <section class="reviews">
                    <div class="swiper reviews-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide box">
                                <img src="images/person/nae.jpeg" alt="">
                                <h3>Naura Aulia Eryazti</h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa
                                    placeat.
                                    Aperiam at sint, eos ex similique facere hic.</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>

                            <div class="swiper-slide box">
                                <img src="images/person/zaskia.jpeg" alt="">
                                <h3>Zaskia Fitri Sholehah</h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa
                                    placeat.
                                    Aperiam at sint, eos ex similique facere hic.</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>

                            <div class="swiper-slide box">
                                <img src="images/person/basil.jpeg" alt="">
                                <h3>Ime Ardanti</h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa
                                    placeat.
                                    Aperiam at sint, eos ex similique facere hic.</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="swiper-slide box">
                                <img src="images/person/akechi.jpeg" alt="">
                                <h3>Neki Chen</h3>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur nihil ipsa
                                    placeat.
                                    Aperiam at sint, eos ex similique facere hic.</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </section>
</main>

<script>
    $('#filter button').each(function() {
        var id = '<?= $cid > 0 ? $cid : 'all' ?>';
        if (id == $(this).attr('data-id')) {
            $(this).addClass('active')
        }
    })
    $('.grid-item').click(function() {
        uni_modal_right('View Product', 'view_prod.php?id=' + $(this).attr('data-id'))
    })
</script>