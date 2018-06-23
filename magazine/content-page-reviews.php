<h3 class="head_msg">Отзывы</h3>
<?php
// Описание: Страница "Отзывы клиентов"

$reviews = new USAM_Customer_Reviews_Theme();
echo $reviews->output_reviews_content();