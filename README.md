Positibe UniqueViews Bundle
===========================

This bundle allow you add a counter system to your visitable entities.

Installation
------------

To install the bundle just add the dependent bundles:

    php composer.phar require positibe/media-bundle

Next, be sure to enable the bundles in your application kernel:

    <?php
    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Positibe\Bundle\UniqueViewsBundle\PositibeUniqueViewsBundle(),

            // ...
        );
    }

Documentation in 2 step
-----------------------

1. Implement the VisitableInterface

    // src/AppBundle/Entity/Post.php

    namespace AppBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Positibe\Bundle\UniqueViewsBundle\Model\VisitableInterface;

    class Post implement VisitableInterface {

        /**
         * @ORM\Column(name="count_views", type="integer")
         */
        protected $countViews = 0;

        /**
         * @ORM\Column(name="slug", type="string", length=255)
         */
        protected $slug;

        public function getSlug()
        {
            return $this->slug;
        }

        /**
         * {@inheritdoc}
         */
        public function getVisitableId()
        {
            return $this->getSlug();
        }

        /**
         * {@inheritdoc}
         */
        public function getVisitableType()
        {
            return 'post';
        }

        /**
         * {@inheritdoc}
         */
        public function onNewViewed()
        {
            return $this->countViews++;
        }

        /**
         * {@inheritdoc}
         */
        public function countViews()
        {
            return $this->countViews;
        }
    }

``Tips:`` You could use the `AbstractVisitable` or `VisitableTrait` instead to minimize your code.

    // src/AppBundle/Entity/Post.php

    namespace AppBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Positibe\Bundle\UniqueViewsBundle\Model\VisitableInterface;

    class Post implement VisitableInterface {

        use VisitableTrait;

        /**
         * @ORM\Column(name="slug", type="string", length=255)
         */
        protected $slug;

        public function getSlug()
        {
            return $this->slug;
        }

        /**
         * {@inheritdoc}
         */
        public function getVisitableId()
        {
            return $this->getSlug();
        }
    }

2. On a countable template you could count views using `positibe_unique_views` function.

    {# app/Resources/views/post/show.html.twig #}

    <h1>{{ post.title }}</h1>
    <p><i class="icon-views"></i> {{ positibe_unique_views(post) }} unique views</p>

2.1. On a countable controller you could count views using `positibe_unique_views.views_counter` service:

    //src/AppBundle/Controller/PostController

    $this->get('positibe_unique_views.views_counter')->count($post);

