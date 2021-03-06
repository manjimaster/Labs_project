@extends('adminlte::page')

@section('title', "Admin's home")

@section('content_header')
    <h1>All articles</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
	@endif
    <!-- page section -->
	<div class="page-section spad">
		<div class="container">
			<div class="blog-posts">
				<!-- Single Post -->
				<div class="single-post">
					@foreach ($articlesContent as $key => $article)
						@if ($article->validation == 0)
							<h3 class="text-danger">TO VALIDATE</h3>
						@endif
						<div class="post-thumbnail">
							<img src="/storage/images/modified/blog/{{$article->article_images->image_url_1}}" alt="">
							<div class="post-date">
								<h2>{{$article->created_at->format('d')}}</h2>
								<h3>{{$article->created_at->format('M')}} {{$article->created_at->format('Y')}}</h3>
							</div>
						</div>
						<div class="post-content">
							<h2 class="post-title">{{$article->title}}</h2>
							<div class="post-meta">
								<a href="">{{$article->users->lastName}} {{$article->users->firstName}}</a>
								@foreach ($article->tags as $tag)
									@if ($tag->validation == 1)
										<a href="">{{$tag->name}}</a>
									@endif
								@endforeach
								<a href="#comments">{{$article->comments->where('validation', 1)->count()}} Comments</a>
							</div>
							<p>{!! $article->preview_content !!}</p>
							<p>{!! $article->full_content !!}</p>
						</div>
						<!-- Post Author -->
						<div class="author">
							<div class="avatar">
								<img src="/storage/images/modified/team/{{$article->users->users_images->image_url_1}}" alt="">
							</div>
							<div class="author-info">
								<h2>{{$article->users->lastName}} {{$article->users->firstName}}, <span>Author</span></h2>
								<p>{{$article->users->biography}}</p>
							</div>
						</div>
						<!-- Commert Form -->
						<div class="row">
							<div class="col-md-9 comment-from border rounded border-dark p-2">
								<h2>Leave a comment</h2>
								<form class="form-class" action="{{route('writeCommentOnAdminAllArticle', $article->id)}}" method="post">
									@csrf
									<div class="row">
										<div class="col-sm-6">
											<input class="border rounded border-dark" type="text" name="name" placeholder="Your name">
										</div>
										<div class="col-sm-6">
											<input class="border rounded border-dark" type="text" name="email" placeholder="Your email">
										</div>
										<div class="col-sm-12">
											<input class="border rounded border-dark" type="text" name="subject" placeholder="Subject">
											<textarea class="border rounded border-dark" name="content" placeholder="Message"></textarea>
											<button class="site-btn" type="submit">send</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- Post Comments -->
						<div id="comments" class="comments">
							<h2>Comments {{$article->comments->where('validation', 1)->count()}}</h2>
							<ul class="comment-list">
								@foreach ($article->comments as $comment)
									@if ($comment->validation == 1)
										<li>
											<div class="avatar">
												@if ($comment->user_id != null)
													<img src="/storage/images/modified/team/{{$comment->image}}" alt="">
												@else
													<img src="/storage/images/modified/avatar/{{$comment->image}}" alt="">
												@endif
											</div>
											<div class="commetn-text">
												<h3>{{$comment->name}} | {{$article->created_at->format('d')}} {{$article->created_at->format('M')}}, {{$article->created_at->format('Y')}} | Reply</h3>
												<p>{{$comment->content}}</p>
											</div>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					@endforeach
					<!-- page section end-->
					<!-- Pagination -->
					<div class="page-pagination">
						@if ($articlesContent->onFirstPage())
						{{-- <p class="disabled"><a href="#">&laquo;</a></p> --}}
						@else
						<a class="btn btn-labsGreen text-labsPurple" href="{{url()->current()}}?page=1" rel="prev"  role="button">&laquo;</a>
						@endif
						
						@for ($i = 1; $i < $nbrArticlesPages+1; $i++)
						@if ($articlesContent->currentPage() != $i)
						<a class="btn btn-labsGreen text-labsPurple" href="{{url()->current()}}?page={{$i}}"  role="button">{{$i}}</a>
						@endif
						@endfor
						
						@if ($articlesContent->hasMorePages())
						<a class="btn btn-labsGreen text-labsPurple" href="{{url()->current()}}?page={{$articlesContent->lastPage()}}" rel="next"  role="button">&raquo;</a>
						@else
						{{-- <p class="disabled"><a href="#">&raquo;</a></p> --}}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@stop