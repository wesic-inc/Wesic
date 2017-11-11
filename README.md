# Best Practice Front



### !! Intégration en mobile first !!

D'abord intégrer le format mobile, puis tablette pour finir avec desktop  

### Git best practices : 

* 
* 
* 

## HTML :

* Validateur W3C : <https://validator.w3.org/>

* Convention de nommage HTML pour le projet : 

	class="nomcontainer-typedebalise" 

	* Exceptions : 


```html
	<nav class="nav"> </nav>
	<article class="article"> </article>
	<header class="header"></header>
	<footer class="footer"></footer>
```


Exemple :

```html
	<div class="container">
		<div class="row">
			<nav class="nav"> <!--  Exception à la règle --> 
			<ul>
				<li>
					<img class="nav-img"> <!--  Container direct : nav -->
				</li>
				<li>
					<img class="nav-img">
				</li>
				<li>
					<img class="nav-img">
				</li>
			</ul>
			</nav>
		</div>
	</div>


	<article class="article news"> 
		<ul>
			<li>
				<img class="article-img">
			</li>
			<li>
				<img class="article-img">
			</li>
			<li>
				<img class="article-img">
			</li>
		</ul>
	</nav>

```
## CSS : 

* Développement en SASS : 

	* Documentation : <http://sass-lang.com/documentation/file.SASS_REFERENCE.html>

	* Pour compiler : <http://koala-app.com/>

* Validateur CSS : <https://jigsaw.w3.org/css-validator/>



### Intégration mobile (basée sur bootstrap) : 

* Breakpoints : 

```css 
	// Small devices (landscape phones, 576px and up)
	@media (min-width: 576px) { ... }

	// Medium devices (tablets, 768px and up)
	@media (min-width: 768px) { ... }

	// Large devices (desktops, 992px and up)
	@media (min-width: 992px) { ... }

	// Extra large devices (large desktops, 1200px and up)
	@media (min-width: 1200px) { ... }
```

* Grille : 

	* Identique à bootstrap (<https://getbootstrap.com/docs/3.3/css/#grid>)

* Composants du core.css (se référer à <https://getbootstrap.com/docs/3.3/components/> et core.html) :


<!-- <img src = "https://media.giphy.com/media/11aMKw40E5nAEE/giphy.gif" title = "good luck" alt = "good luck"> -->

