<div class="custom-select">
    <button class="select-button">
        <span class="selected-value">Сортировка</span>
        <span class="arrow">
            <img src="./assets/images/catalog-arrow.png" alt="">
        </span>
    </button>
    <ul class="select-dropdown" role="listbox" id="select-dropdown">
        <li role="option">
            <input type="radio" id="price-low" name="price-low">
            <label for="price-low">
                <i class="bx bxl-price-low"></i>
                Сначала дешевые
            </label>
        </li>
        <li role="option">
            <input type="radio" id="price-high" name="price-high">
            <label for="price-high">
                <i class="bx bxl-price-high"></i>
                Сначала дорогие
            </label>
        </li>
        <li role="option">
            <input type="radio" id="sort-az" name="sort-az">
            <label for="sort-az">
                <i class="bx bxl-facebook-circle"></i>
                сортировка по алфавиту А-Я
            </label>
        </li>
        <li role="option">
            <input type="radio" id="sort-za" name="sort-za">
            <label for="sort-za">
                <i class="bx bxl-linkedin-square"></i>
                сортировка по алфавиту Я-А
            </label>
        </li>
    </ul>
</div>