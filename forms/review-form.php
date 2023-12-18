<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?><div>
	<form class="ajax-form" id="form-review" data-command="form.review">
		<div class="title">Оставьте отзыв</div>
	
		<div class="rating"
			data-rating-stars="5"
			data-rating-value="1"
			data-rating-input="#form-review-rating">
		</div>
		<input type="hidden" id="form-review-rating" name="rating">
	
	
		<div class="fields">
			<label>
				<span>Сообщение <span class="star">*</span></span>
				<textarea name="message" id="" cols="30" rows="10"></textarea>
			</label>
	
			<label>
				Ваша фотография
				<div class="photo">
					<input type="file" name="photo">
					<span>Прикрепите файл</span>
				</div>
			</label>
	
			<label>
				Файл
				<div class="file">
					<input type="file" name="file">
					<span>Прикрепите файл</span>
				</div>
			</label>
	
			<label>
				<span>Ваше имя <span class="star">*</span></span>
				<input type="text" name="name">
			</label>
	
			<label>
				Должность
				<input type="text" name="post">
			</label>
	
			<label>
				<span>E-mail <span class="star">*</span></span>
				<input type="text" name="email">
			</label>
	
			<label>
				Телефон
				<input type="text" class="inputmask" placeholder="" name="phone">
			</label>
	
			<label class="checkbox">
				<input type="checkbox" name="agreement" checked="" value="on" id="">
				<div class="switch-btn switch-on"></div>
	
				<span class="text-grey">
					Я согласен на
					<a href="" data-fancybox="" data-type="ajax" data-src="/include/licenses_detail.php">обработку персональных данных</a>
				</span>
			</label>
	
		</div>
		<button class="sms__btn button">Отправить</button>
	</form>
</div>