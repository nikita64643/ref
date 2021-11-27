@extends('layout')

@section('content')
	<link href="{{ asset('assets/css/support.css') }}" rel="stylesheet"> 
<!--	<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"> -->
	
<div class="content">
	<!-- <middle> -->
	@if($u->ban_ticket != 1)
	@if($u->ref == 1) <div class="other-title">Ваш реферальный код: {{$u->ref_url}}</div>
	@else <div class="other-title">Партнёрская программа</div>
	@endif	

	<div class="support">
		<div class="suptext-big">Купоны</div>
		<div class="coupon_form">
			<div class="go-ref">
				Баланс: {{ $u->money }} руб.
			</div>

			@if($u->ref_bonus == 0)
			<form action="/ref" method="POST">
				<div class="page-main-block left">
					<div class="page-block">
						<div class="coupon_form_get">
							<input type="text" name="title" class="coupon" maxlength="20" placeholder="№ КУПОНА" required="">
							<button class="coupon_get" type="submit" name="refer">Подтвердить купон</button>
						</div>
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
					</div>
				</div>
			</form>
			@endif
			@if($u->ref == 0)
			<form action="/ref" method="POST">
				<div class="page-main-block left" style="margin-left: 10px;">
					<div class="page-block">
						<div class="coupon_form_get">
							<input type="text" name="title" class="coupon" maxlength="20" placeholder="№ КУПОНА" required="">
							<button class="coupon_get" type="submit" name="submit">Создать купон</button>
						</div>
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
					</div>
				</div>
			</form>
			@endif
		</div>
		
		
		
		
		
			<div class="suptext-big">Информация</div>
		
		<div class="coupon_form">
			<ol>
				<li><span style="color: rgba(0, 0, 0, 0.7);">- После активации кода вы получаете 10 руб. на свой счет. Вы можете потратить их в магазине, на ставках или поиграть с ними на сайте.</span></li>
				<li><span style="color: rgba(0, 0, 0, 0.7);">- Регистрация кода возможна только один раз!</span></li>
				<li><span style="color: rgba(0, 0, 0, 0.7);">- Если вы будете спамить в сообществе стим или на других официальных ресурсах стим вы получите бан НАВСЕГДА!</span></li>
				
				<li><span style="color: rgba(0, 0, 0, 0.7);">Чтобы получить своего реферала:</span></li>
				<li><span style="color: rgba(0, 0, 0, 0.7);">- Попросите своего друга \ знакомого активировать Ваш личный код у себя в реферальной системе.</span></li>
				<li><span style="color: rgba(0, 0, 0, 0.7);">- Ваш друг сразу же получит 10 руб. на свой счет, а Вы получайте 1% от каждого его выигрыша!</span></li>
				<li><span style="color: rgba(0, 0, 0, 0.7);">- А также, Вы получаете разовый бонус в размере 5 руб. с каждого реферала<span style="color: #D92B4C;">[Действует до 03.03.2016]</span></span></li>
			</ol>
		</div>	
		
		
		
		
		<div class="suptext-big">Ваши рефералы</div>
		

					
		<div class="table">
									
			<div class="ref-list">
				<div class="tb1">Дата</div>
				<div class="tb2">Прибыль</div>
				<div class="tb3">Пользователь</div>
				<div class="tb4">Код партнёра</div>

			</div>
						@forelse($refers as $refer)
			<div class="ref-list">

				<div class="tb1">{{$refer->date_ref}}</div>
				<div class="tb2">фэйк</div>
				<div class="tb3">{{$refer->username}}</div>
				<div class="tb4">{{$refer->ref_url_bonus}}</div>
			</div>
		
		@empty
		<div class="suptext-big" style="width: 380px;color: rgba(0, 0, 0, 0.45);font-weight: 400;">Вы еще не пригласили ни одного человека</div>
		@endforelse
		</div>
		

	</div>
	@else	
	<div class="other-title">Ошибка! Вы были заблокированы за флуд.</div>		
	@endif
	</div>

@endsection