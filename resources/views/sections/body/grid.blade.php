<section class="grid">

	<div class="bg-secondary">

		<div class="container">

			<div class="row fitness-first">

				<div class="col-lg-7 text-block">

					<div class="text-lockup">

						<h3>{{$grid_first_title}}</h3>

						<h2>{{$grid_first_subtitle}}</h2>

						<img src="resources/img/drop-muted.png" alt="" />

						<p>{{$grid_first_text}}</p>

					</div>

				</div>

				<div class="col-lg-13 large-thumb">

					<div class="stats">

						<p>{{$event_count_label}} <span>({{$event_count}})</span></p>

						<img src="resources/img/drop-primary.png" alt="" />

					</div>

				</div>

			</div>

			<div class="row love-your-body">

				<div class="col-lg-13 large-thumb">

					<div class="stats">

						<p>{{$user_count_label}} <span>({{$user_count}})</span></p>

						<img src="resources/img/drop-primary.png" alt="" />

					</div>

				</div>

				<div class="col-lg-7 text-block">

					<div class="text-lockup">

						<h3>{{$grid_second_title}}</h3>

						<h2>{{$grid_second_subtitle}}</h2>

						<img src="resources/img/drop-muted.png" alt="" />

						<p>{{$grid_second_text}}</p>

					</div>

				</div>

			</div>

		</div>

	</div>

	<div class="container">

		<div class="row mid-unit">

			<div class="col-lg-7 lifestyle">

				<div class="small-thumb"></div>

				<div class="text-block">

					<div class="text-lockup">

						<h3>{{$grid_third_title}}</h3>

						<h2>{{$grid_third_subtitle}}</h2>

						<p>{{$grid_third_text}}</p>

						<i class="icon-user"></i>

					</div>

				</div>

			</div>

			<div class="col-lg-13 summer-fun">

				<div class="large-thumb">

				</div>

				<div class="text-block">

					<div class="text-lockup">

						<h2>{{$block_first_title}}</h2>

						<p>{{$block_first_text}}</p>

					</div>

				</div>

			</div>

		</div>

		<div class="row bottom-unit">

			<div class="col-lg-13 get-involved">

				<div class="large-thumb"></div>

				<div class="text-block">

					<div class="text-lockup">

						<h3>{{$block_second_title}}</h3>

						<h2>{{$block_second_subtitle}}</h2>

						<p>{{$block_second_text}}</p>

					</div>

				</div>

			</div>

			<div class="col-lg-7 eating-habits">

				<div class="small-thumb"></div>

				<div class="text-block">

					<div class="text-lockup">

						<h3>{{$block_third_title}}</h3>

						<h2>{{$block_third_subtitle}}</h2>

						<p>{{$block_third_text}}</p>

					</div>

				</div>

			</div>

			<div class="col-lg-20 eating-habits">	
				<div class="stats">
					<p class="special bg-secondary"><img src="resources/img/avocado.png" alt="" /> {{$event_count_label}}  <span>(<strong>{{$event_count}}</strong>)</span></p>
				</div>
				<div id="map" data-start-lat="{{$app_start_position_lat}}" data-start-lng="{{$app_start_position_lng}}"></div>
			</div>

		</div>

	</div>

</section>