
<!-- start section -->
<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-9">
				<div class="content-container">
					<!-- start posts -->
					<div class="posts">
						<div class="__item">
							<img class="img-fluid" width="878" height="586" src="<?php echo base_url($post->image) ?>" alt="demo" />

							<div class="mt-6 mt-lg-10 mb-lg-4">
								<div class="row align-items-sm-center justify-content-sm-between">
									<div class="col-12 col-sm-auto mb-4">
										<div class="post-author">
											<div class="d-table">
												<div class="d-table-cell align-middle">
													<span class="post-author__name"><?php echo html_escape($post->category) ?></span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 col-sm-auto mb-4">
										<time> <?php echo my_date_show($post->created_at) ?></time>
									</div>
								</div>
							</div>

							<h3>
								<?php echo html_escape($post->title) ?>
							</h3>

							<p>
								<?php echo strip_tags($post->details) ?>
							</p>

							<?php if (!empty($tags)): ?>
								<div class="my-6 my-md-11">
									<div class="h5">Tags:</div>
									<div class="tags-list">
										<ul class="">
											<?php foreach ($tags as $tag): ?>
												<li><a href="#"><?php echo html_escape($tag->tag) ?></a></li>
											<?php endforeach ?>
										</ul>
									</div>
								</div>
							<?php endif ?>

							<div>
								<div class="share-btns">
								</div>
							</div>

						</div>
					</div>
					<!-- end posts -->
				</div>

				<?php if (!empty($comments)): ?>
					<div class="py-3 py-md-6 py-lg-12">
						<h4 class="mb-6">Comments - (<?php echo html_escape(count($comments)) ?>)</h4>
						<!-- start comments list -->
						<ul class="comments-list">
							
							<li class="comment">
								<table>
									<?php foreach ($comments as $comment): ?>
									<tr>
										<td class="align-top">
											<div class="d-none d-lg-block">
												<div class="comment__author-img">
													<img class="img-fluid" width="70" height="70" src="img/ava_1.jpg" alt="demo" />
												</div>
											</div>
										</td>

										<td class="align-top" width="100%">
											<div class="d-flex align-items-center mb-3 mb-lg-0">
												<div class="d-block d-lg-none">
													<div class="comment__author-img">
														<img class="img-fluid" width="70" height="70" src="img/ava_1.jpg" alt="demo" />
													</div>

												</div>
												<span class="comment__author-name"><?php echo html_escape($comment->name); ?> &emsp; <time class="post-meta__item __date-post"><?php echo my_date_show($comment->created_at); ?></time></span>
											</div>

											<p>
												<?php echo html_escape($comment->message); ?>
											</p>
										</td>
									</tr>
									<?php endforeach ?>
								</table>
							</li>
							
						</ul>
						<!-- end comments list -->
					</div>
				<?php endif; ?>

				<div class="pt-3 pt-md-6 pt-lg-12">
					<h4 class="mb-6">Send Message</h4>

					<form method="post" class="site-form" action="<?php echo base_url('home/send_comment/'.html_escape($post->id)); ?>">
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="input-wrp">
									<input class="textfield textfield--grey" name="name" type="text" placeholder="Full Name" />
								</div>
							</div>

							<div class="col-12 col-sm-6">
								<div class="input-wrp">
									<input class="textfield textfield--grey" name="email" type="text" placeholder="E-mail" required inputmode="email" x-inputmode="email" />
								</div>
							</div>
						</div>

						<div class="input-wrp">
							<textarea class="textfield textfield--grey" name="message" placeholder="Comments" required></textarea>
						</div>

						<!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

						<button class="custom-btn custom-btn--medium custom-btn--style-2" type="submit" role="button">Post comment</button>
					</form>
				</div>

			</div>

			<div class="spacer py-4 d-lg-none"></div>

			<div class="col-12 col-lg-4 col-xl-3">

				<!-- start sidebar -->
				<aside class="sidebar">
					<!-- start widget -->
					<div class="widget widget--categories">
						<h4 class="widget-title">Category</h4>

						<ul class="list">
							<?php foreach ($categories as $category): ?>
								<li class="list__item">
									<a class="list__item__link" href="<?php echo base_url('category/'.$category->slug) ?>"><?php echo html_escape($category->name) ?><span class="post-count"><?php echo count_posts_by_categories($category->id) ?></span></a>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
					<!-- end widget -->

					<!-- start widget -->
					<div class="widget widget--posts">
						<h4 class="widget-title">Related Posts</h4>

						<div>
							<?php foreach ($related_posts as $post): ?>
							<article>
								<div class="row no-gutters">
									<div class="col-auto __image-wrap">
										<figure class="__image">
											<a href="<?php echo base_url('post/'.$post->slug) ?>">
												<img src="<?php echo base_url($post->image) ?>" alt="demo" />
											</a>
										</figure>
									</div>

									<div class="col">
										<h5 class="__title"><a href="<?php echo base_url('post/'.$post->slug) ?>"><?php echo html_escape($post->title) ?></a></h5>

										<div class="post-meta">
											<time class="post-meta__item __date-post"><?php echo my_date_show($post->created_at) ?></time>
										</div>
									</div>
								</div>
							</article>
							<?php endforeach ?>
						</div>
					</div>
					<!-- end widget -->

					<!-- start widget -->
					<div class="widget widget--banner">
						<a href="#">
							<img class="img-fluid lazy" width="271" height="305" src="img/blank.gif" data-src="img/widget_banner.jpg" alt="demo" />
						</a>
					</div>
					<!-- end widget -->
				</aside>
				<!-- end sidebar -->

			</div>
		</div>
	</div>
</section>
<!-- end section -->