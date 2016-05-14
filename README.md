Positibe UniqueViews Bundle
===========================

This bundle allow you add a counter system to your visitable entities.

Installation
------------



Documentation
-------------

1. Implement the VisitableInterface

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

``Tips:`` You can use the `AbstractVisitable` or `VisitableTrait`.

2. In the template countable you can to count a views via `positibe_unique_views` function.

    {# app/Resources/views/post/show.html.twig #}

    <h1>{{ post.title }}</h1>
    <p><i class="icon-views"></i> {{ positibe_unique_views(post) }} unique views</p>

2.1. In the controller countable you can to count a views via `positibe_unique_views.views_counter` service:

    // src/AppBundle/Controller/PostController
    
    $this->get('positibe_unique_views.views_counter')->count($post);

