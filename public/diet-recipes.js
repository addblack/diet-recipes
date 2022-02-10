const recipesBlock = document.getElementById('recipes');

if (recipesBlock) {
  const api_url = `${diet_recipes_data.resturl}dr/v1/recipes`;

  const result = document.getElementById('results');
  const loader = document.querySelector('.loader');

  const searchInput = document.getElementById('search-input');

  searchInput.addEventListener('keyup', (e) => {
    const searchVal = e.target.value.toLowerCase();
    search(searchVal);
  })

  /**
   * @description Search recipe by title
   * @param value - recipe title
   */
  function search(value) {
    fetch(api_url + `?title=${value}`).then((res) => {
      return res.json();
    }).then((recipes) => {
      result.innerHTML = '';
      createAndInsertRecipes(recipes);

      if (recipes.length === 0) {
        result.innerHTML = 'sorry, no recipes :('
      }
    }).catch((error) => {
      console.log(error)
    })
  }

  fetch(api_url)
    .then((res) => {
      return res.json();
    })
    .then((recipes) => {
      createAndInsertRecipes(recipes);
    })
    .finally(() => {
      loader.classList.add('hidden');
    })
    .catch((error) => {
      console.error(error);
    });

  function createAndInsertRecipes(recipes = []) {
    recipes.forEach((recipe) => {
      const newRecipe = dietCreateRecipeHtml(recipe);
      result.insertAdjacentHTML('beforeend', newRecipe);
    })
  }

  /**
   * @description Function that render html img tag with star icon
   * @count - how much stars you need
   * @return string
   */
  const dietStars = (count) => {
    let i = 0;
    let str = '';
    while (i < count - 1) {
      str += `<img src='/wp-content/plugins/diet-recipes/public/star.svg' alt="cooktime" width="20px" height="20px">`;
      i++;
    }
    return str;
  }

  /**
   * @param title - Post title
   * @param meta - object with post metadata
   * @param image - url to post thumbnail
   * @returns {string} - Html markup with data from api
   */
  function dietCreateRecipeHtml({title, meta, image_url}) {

    if (!title) {
      title = 'Cool Recipe';
    }

    if (!image_url) {
      image_url = '/wp-content/plugins/diet-recipes/public/default.jpg';
    }

    const {diet_recipe_cooktime, diet_recipe_rating, diet_recipe_short_description} = meta;
    const trimDescription = diet_recipe_short_description.substring(0, 163);

    const starsImages = dietStars(Number(diet_recipe_rating));

    return (
      `<div class="recipe">
        <div class="recipe__image" style="background-image: url(${image_url})"></div>
            <div class="recipe__info">
                <p class="recipe__title">${title}</p>
                <p class="recipe__desc">
                    ${trimDescription}
                </p>
                <div class="recipe__footer">
                    <div class="recipe__footer-cooktime">
                      <img src="/wp-content/plugins/diet-recipes/public/clock.svg" alt="cooktime" width="20px" height="20px">
                          ${diet_recipe_cooktime}
                          <span>minutes</span>
                    </div>
                    <div class="recipe__footer-rating">
                        <img src="/wp-content/plugins/diet-recipes/public/star.svg" alt="cooktime" width="20px" height="20px">
                        ${starsImages}
                    </div>
                </div>
        </div>
      </div>`
    )
  }

}

