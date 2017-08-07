<?php
include_once ROOT_DIR . '/template/blocks/header.php';
?>
<div id="page_restore">

<form>
	<div class="t_center">Введите ваш новый пароль.</div>
    <div class="login-input">
		<input class="ainput" type="password" name="password" placeholder="Введите пароль" autocomplete="off">
		<svg xmlns="http://www.w3.org/2000/svg" width="13" height="18" viewBox="0 0 13 18">
			<path fill="#227A9C" fill-rule="nonzero" d="M11.987 7.524h-.254v-2.25A5.28 5.28 0 0 0 6.458 0a5.28 5.28 0 0 0-5.274 5.275.48.48 0 0 0 .482.482.48.48 0 0 0 .483-.482A4.314 4.314 0 0 1 6.46.965a4.314 4.314 0 0 1 4.308 4.31v2.249H.933A.934.934 0 0 0 0 8.457v6.011a2.8 2.8 0 0 0 2.796 2.797h7.328a2.8 2.8 0 0 0 2.796-2.797v-6.01a.934.934 0 0 0-.933-.934zm-.033 6.944c0 1.009-.818 1.831-1.83 1.831H2.8a1.832 1.832 0 0 1-1.83-1.83v-5.98h10.984v5.98zm-5.492-.196c.997 0 1.806-.812 1.806-1.806 0-.998-.812-1.806-1.806-1.806-.998 0-1.806.812-1.806 1.806s.808 1.806 1.806 1.806zm0-2.65a.842.842 0 0 1 0 1.684.842.842 0 0 1 0-1.684z"/>
		</svg>
	</div>
	<button class="abutton">Сохранить</button>
</form>

</div>
<?php
include_once ROOT_DIR . '/template/blocks/footer.php';
?>