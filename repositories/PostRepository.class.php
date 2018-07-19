<?php 
class PostRepository extends Basesql
{

    /**
     * [newArticle description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function newArticle($data)
    {
        if (isset($data['draft'])) {
            $status = 2;
            $flashmessage = "L'article <i>\"".ucfirst($data['title'])."\"</i> a bien été engistré comme brouillon";
        }
        if (isset($data['save'])) {
            $status = 1;
            $flashmessage = "L'article <i>\"".ucfirst($data['title'])."\"</i> a bien été publié";
        }

        $slug = new Slug();
        $slug->setSlug($data['slug']);
        $slug->setType(1);
        $slug->save();



        $datePublied = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";

        $article = new Post();

        $article->setType(1);
        $article->setTitle($data['title']);
        $article->setSlug($data['slug']);
        $article->setContent(htmlentities($data['wesic-wysiwyg']));
        $article->setExcerpt($data['excerpt']);
        $article->setDescription($data['description']);
        $article->setPublishedAt($datePublied);
        $article->setCreatedAt();
        $article->setStatus($status);

        if($data['featured'] != 0){
            $article->setFeatured($data['featured']);
        }
        $article->setVisibility($data['visibility']);
        $article->setUserId(Singleton::getUser()->getId());
        $article->save();

        View::setFlash("Succès !", $flashmessage, "success");

        $qb = new QueryBuilder();

        $newArticle = $qb->findAll('post')->where('slug', $data['slug'])->fetchOne();

        Category::createCategoryJoin($data['category'], $article->getId());
        
        if(!empty($data['tags'])){            
            $tags = Category::addTags(json_decode($data['tags']));
            Category::attachTagsToPost($tags, 59);
        }

        return true;
    }

    /**
     * [newPage description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function newPage($data)
    {
        $slug = new Slug();
        $slug->setSlug($data['slug']);
        $slug->setType(2);
        $slug->save();

        $datePublied = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";

        $page = new Post();
        $page->setType(2);
        $page->setTitle($data['title']);
        $page->setSlug($data['slug']);
        $page->setContent(htmlentities($data['wesic-wysiwyg']));
        $page->setPublishedAt($datePublied);
        $page->setCreatedAt();
        if($data['parent'] != 'none'){
            $page->setParent($data['parent']);
        }
        $page->setStatus(1);
        $page->setVisibility(1);
        $page->setUserId(Singleton::getUser()->getId());
        $page->save();

        View::setFlash("Succès !", "La page <i>".ucfirst($data['title'])."</i> a bien été ajoutée", "success");


        return true;
    }

    /**
     * [editArticle description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editArticle($data)
    {
        if (isset($data['draft'])) {
            $status = 2;
            $flashmessage = "L'article <i>\"".ucfirst($data['title'])."\"</i> a bien été modifié comme brouillon";
        }
        if (isset($data['save'])) {
            $status = 1;
            $flashmessage = "L'article <i>\"".ucfirst($data['title'])."\"</i> a bien été modifié";
        }

        $qb = new QueryBuilder();

        $currentPost = $qb->findAll('post')->addWhere('id = :id')->setParameter('id', $data['id'])->fetchOne();


        if ($currentPost['slug'] == $data['slug']) {
            $slug = $currentPost['slug'];
            $slugUpdate = false;
        } else {
            $slug = $data['slug'];

            $newSlug = new Slug();
            $newSlug->setSlug($slug);
            $newSlug->setType(1);
            $newSlug->save();

            $slugUpdate = true;
        }

        $datePublied = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";

        $article = new Post();

        $article->setType(1);
        $article->setId($data['id']);
        $article->setTitle($data['title']);
        $article->setSlug($slug);
        $article->setContent(htmlentities($data['wesic-wysiwyg']));
        $article->setExcerpt($data['excerpt']);
        $article->setDescription($data['description']);
        $article->setPublishedAt($datePublied);
        $article->setStatus($status);
        $article->setVisibility($data['visibility']);
        $article->setUserId(Singleton::getUser()->getId());
        $article->save();

        View::setFlash("Succès !", $flashmessage, "success");

        if ($slugUpdate == true) {
            $qb->reset();
            $qb->delete()->from('slug')->addWhere('slug = :slug')->setParameter('slug', $currentPost['slug'])->execute();
        }

        Category::createCategoryJoin($data['category'], $data['id']);


        return true;
    }

    /**
     * [editPage description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function editPage($data)
    {
        $slug = new Slug();
        $slug->setSlug($data['slug']);
        $slug->setType(2);
        $slug->save();


        $qb = new QueryBuilder();

        $currentPost = $qb->findAll('post')->addWhere('id = :id')->setParameter('id', $data['id'])->fetchOne();


        if ($currentPost['slug'] == $data['slug']) {
            $slug = $currentPost['slug'];
            $slugUpdate = false;
        } else {
            $slug = $data['slug'];

            $newSlug = new Slug();
            $newSlug->setSlug($slug);
            $newSlug->setType(1);
            $newSlug->save();

            $slugUpdate = true;
        }


        $datePublied = $data['aa']."-".$data['mm']."-".$data['jj']." ".$data['hh'].":".$data['mn'].":00";

        $page = new Post();
        $page->setType(2);
        $page->setId($data['id']);
        $page->setTitle($data['title']);
        $page->setSlug($data['slug']);
        $page->setContent(htmlentities($data['wesic-wysiwyg']));
        $page->setPublishedAt($datePublied);
        $page->setCreatedAt();
        $page->setStatus(1);
        $page->setVisibility(1);
        $page->setUserId(Singleton::getUser()->getId());
        $page->save();


        if ($slugUpdate == true) {
            $qb->reset();
            $qb->delete()->from('slug')->addWhere('slug = :slug')->setParameter('slug', $currentPost['slug'])->execute();
        }


        View::setFlash("Succès !", "La page <i>".ucfirst($data['title'])."</i> a bien été modifié", "success");


        return true;
    }

    /**
     * [deleteArticle description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function deleteArticle($id)
    {
        $qb = new QueryBuilder();

        $toDelete = $qb->findAll('post')
        ->addWhere('id = :id')
        ->setParameter('id', $id)
        ->fetchOne();

        $qb->reset();

        $qb->delete()
        ->from('join_article_category')
        ->addWhere('post_id = :post_id')
        ->setParameter('post_id', $id)
        ->execute();

        $qb->reset();

        $qb->delete()
        ->from('post')
        ->addWhere('id = :id')
        ->setParameter('id', $id)
        ->execute();


        $qb->reset();

        $qb->delete()
        ->from('slug')
        ->addWhere('slug = :slug')
        ->setParameter('slug', $toDelete['slug'])
        ->execute();

        View::setFlash("Succès !", "L'article <i>".$toDelete['title']."</i> a bien été supprimé", "danger");
    }

    /**
     * [deletePage description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function deletePage($id)
    {
        $qb = new QueryBuilder();

        $toDelete = $qb->findAll('post')
        ->addWhere('id = :id')
        ->setParameter('id', $id)
        ->fetchOne();

        $qb->reset();

        $qb->delete()
        ->from('post')
        ->addWhere('id = :id')
        ->setParameter('id', $id)
        ->execute();

        $qb->reset();


        $qb->delete()
        ->from('slug')
        ->addWhere('slug = :slug')
        ->setParameter('slug', $toDelete['slug'])
        ->execute();

        View::setFlash("Succès !", "La page <i>".$toDelete['title']."</i> a bien été supprimée", "danger");
    }

    /**
     * [setPostStatus description]
     * @param int $id     [description]
     * @param int $status [description]
     * @return  bool
     */
    public static function setPostStatus($id, $status)
    {
        if ($status == 1 || $status == 2 || $status == 3) {
            $post = new Post();
            $post->setStatus($status);
            $post->setId($id);
            $post->save();
            return true;
        } else {
            return false;
        }
    }


    public static function getParentPageList(){

            $pages = glob('themes/'.setting('theme').'/views/*.php');

            $parentCandidate = [];
            $parentCandidate['none'] = 'Aucune';

            foreach ($pages as $key=>$value) {

                    $name =  explode('/',$value)[3];
                    if($name != 'archive.php' && $name != 'article.php' && $name != 'home.php'){
                        $parentCandidate[$name] = $name;
                    }
            }

            return $parentCandidate;
    }
}
