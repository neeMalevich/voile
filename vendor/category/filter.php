<?php
$sizes = get_filter_column('sizes', 'size');
$colors = get_filter_column('colors', 'color');
$materials= get_filter_column('materials', 'material');
?>

<form class="filters" method="post">
    <div class="filters-border-top"></div>
    <div class="accordion">
        <div class="accordion-item active price">
            <h2>
                ЦЕНА <img src="./assets/images/catalog-arrow.png" alt="">
            </h2>
            <div class="accordion-price accordion-content" style="max-height: fit-content;">
                <div class="accordion-price_item">
                    <span>от</span>
                    <input type="text" name="price_min" value="" class="accordion-price_input">
                </div>
                <div class="accordion-price_item">
                    <span> - до </span>
                    <input type="text" name="price_max" value="" class="accordion-price_input">
                </div>
            </div>

        </div>
    </div>
    <div class="accordion">
        <div class="accordion-item active size">
            <h2>
                РАЗМЕР <img src="./assets/images/catalog-arrow.png" alt="">
            </h2>
            <div class="accordion-content" style="max-height: fit-content;">
                <?php foreach ($sizes as $size) : ?>
                    <label for="<?= $size['filter_column']; ?>" class="option">
                        <input type="checkbox" id="<?= $size['filter_column']; ?>" name="<?= $size['filter_column']; ?>"                                        />
                        <span class="checkbox checkbox1"><?= $size['size']; ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="accordion">
        <div class="accordion-item active color">
            <h2>
                Цвет <img src="./assets/images/catalog-arrow.png" alt="">
            </h2>

            <div class="accordion-content" style="max-height: fit-content;">
                <?php foreach ($colors as $color) : ?>
                    <label for="<?= $color['filter_column']; ?>" class="option bg--<?= $color['hex']; ?>">
                        <input type="checkbox" id="<?= $color['filter_column']; ?>" name="<?= $color['filter_column']; ?>"                                        />
                        <span class="checkbox checkbox1"></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="accordion">
        <div class="accordion-item active">
            <h2>
                МАТЕРИАЛ <img src="./assets/images/catalog-arrow.png" alt="">
            </h2>
            <div class="accordion-content" style="max-height: fit-content;">
                <?php foreach ($materials as $material) : ?>
                    <label for="<?= $material['filter_column']; ?>" class="option">
                        <?= $material['material']; ?>
                        <input type="checkbox" id="<?= $material['filter_column']; ?>" name="<?= $material['filter_column']; ?>"                                        />
                        <span class="checkbox checkbox1"></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="filters-border-bottom"></div>
</form>

<style>
    <?php foreach ($colors as $color) : ?>
        .bg--<?= $color['hex']; ?> .checkbox1:after {
            border-color: #<?= $color['hex']; ?>;
        }
        .bg--<?= $color['hex']; ?> .checkbox {
            background-color: #<?= $color['hex']; ?>;
            border-color: #<?= $color['hex']; ?>;
        }
    <?php endforeach; ?>
</style>
