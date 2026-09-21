<script type="text/javascript">
	window.addEventListener("load", getReadyToLazyLoad);
	window.addEventListener("scroll", getReadyToLazyLoad);

	function getReadyToLazyLoad(){
	  var imagesArray = document.querySelectorAll('img, iframe, .lazyload');
	  imagesArray.forEach((item)=>{
	    var imageOffset = item.getBoundingClientRect().top - window.innerHeight;
	    if(item.hasAttribute("data-url")){ 
	      if(imageOffset <= 150){
	        var attrbs = item.getAttribute('data-url');
	        item.setAttribute("src", attrbs);
	        item.removeAttribute('data-url');
	        return;
	      }
	    }else if(item.hasAttribute("data-bg-img")){
	      if(imageOffset <= 150){
	        var attrbs = item.getAttribute('data-bg-img');
	        item.setAttribute("style", `background-image: url('${attrbs}')`);
	        item.removeAttribute('data-bg-img');
	        return;
	      }
	    }
	  });
	}
</script>

<script>
	window.addEventListener("load", runAnimations);
	window.addEventListener("scroll", runAnimations);
	
	function runAnimations(){
		let animatedItems = document.querySelectorAll(".fade-in, .fade-from-left, .fade-from-right, .fade-from-bottom");
		animatedItems.forEach((item)=>{
			let top = item.getBoundingClientRect().top;
			if(top < (.85 * window.innerHeight)){
				item.classList.add("active");
			}
		});
	}
	
</script>

<script>
	/*The site header (markup in header.php): the burger menu, the solid state once the page scrolls, and the menu link of the section being read.*/
	(function() {
		let header = document.querySelector(".site-header");
		if (!header) {
			return;
		}
		let burger = header.querySelector(".burger");
		let links = header.querySelectorAll(".header-menu a");

		function setMenu(open) {
			header.classList.toggle("is-open", open);
			if (burger) {
				burger.setAttribute("aria-expanded", open ? "true" : "false");
			}
		}

		if (burger) {
			burger.addEventListener("click", function() {
				setMenu(!header.classList.contains("is-open"));
			});
		}

		/*A tap on a menu link, a tap outside the header or Escape closes the folded menu*/
		document.addEventListener("click", function(event) {
			if (header.classList.contains("is-open") && (!header.contains(event.target) || event.target.closest(".header-nav a"))) {
				setMenu(false);
			}
		});

		document.addEventListener("keydown", function(event) {
			if (event.key === "Escape") {
				setMenu(false);
			}
		});

		/*Only links that point at a section of this very page take part in the highlight. The first one counts until another section takes over.*/
		let anchors = [];
		links.forEach(function(link) {
			if (link.hash.length > 1 && link.origin + link.pathname === window.location.origin + window.location.pathname) {
				anchors.push(link);
			}
		});

		function onScroll() {
			header.classList.toggle("is-scrolled", window.scrollY > 24);
			if (!anchors.length) {
				return;
			}
			let current = anchors[0];
			anchors.forEach(function(link) {
				let target = null;
				try {
					target = document.querySelector(link.hash);
				} catch (error) {
					target = null;
				}
				if (target && target.getBoundingClientRect().top <= window.innerHeight * .35) {
					current = link;
				}
			});
			anchors.forEach(function(link) {
				link.classList.toggle("is-active", link === current);
			});
		}

		window.addEventListener("scroll", onScroll, {passive: true});
		onScroll();
	})();
</script>
