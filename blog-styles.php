<style type="text/css">
	.posts-container.has-blogs{display: grid; grid-template-columns: 1fr 1fr 1fr; grid-gap: 25px;}
	.posts-container.no-blogs{text-align: center;}
	.indiv-post{border: 1px solid #ddd; border-radius: 5px; overflow: hidden; transition: box-shadow .25s, transform .25s;}
	.indiv-post:hover{transform: translateY(-3px); box-shadow: 0 0 15px rgba(0 0 0 / 30%);}
	.indiv-post .img-container{display: block; overflow: hidden; height: 250px; margin: 0; position: relative;}
	.indiv-post .img-container img{height: 250px; width: 100%; object-fit: cover; object-position: center 13%; transition: transform .25s;}
	.indiv-post .img-container img:hover{transform: scale(1.05);}
	.indiv-post .empty-thumb-container{position: absolute; height: 100%; width: 100%; background-image: linear-gradient(148deg, var(--color-2), white); display: block; top: 0; left: 0; opacity: .8;}
	.indiv-post .post-info{position: relative; padding: 1.5em 15px;}
	.indiv-post .date{position: absolute; display: grid; grid-template-columns: 50px 1fr; background: white; padding: 10px; margin: 0; top: -75px; left: 0; font-size: 16px; font-weight: lighter; align-items: center;}
	.indiv-post .date .day{font-size: 40px;}
	.indiv-post .date .month{display: block;}
	.indiv-post h2{font-size: 30px; margin: 0;}
	.indiv-post .post-info p{margin: 1em 0 2em;}
	.nav-links{margin-top: 2em; text-align: center;}
	.nav-links > *{display: inline-flex; width: 35px; height: 35px; border: 1px solid #ccc; border-radius: 500px; justify-content: center; align-items: center; transition: background .25s, color .25s;}
	.nav-links > *:not(.dots):hover{background: var(--color-2); color: var(--color-on-accent); border: transparent;}
	.nav-links > .page-numbers{color: #ccc;}
	.nav-links > .page-numbers.current{background: var(--color-2); color: var(--color-on-accent); border-color: transparent;}
	.nav-links .prev span{transform: scaleX(.5); position: relative; top: -1px; left: -1px;}
	.nav-links .next span{transform: scaleX(.5); position: relative; top: -1px; right: -1px;}
	@media(max-width: 900px){
		.posts-container.has-blogs{display: grid; grid-template-columns: 1fr 1fr; grid-gap: 25px;}
	}
	@media(max-width: 700px){
		.posts-container.has-blogs{display: flex; flex-wrap: wrap; grid-gap: 25px;}
		.posts-container.has-blogs > div{width: 340px; max-width: 100%; margin: 0 auto;}
	}
</style>

