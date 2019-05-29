<?php
namespace Classes;

use Vendor\Database;

class Page {
    /**
     * Cache var
     */
    protected $sql;
    /**
     * Cache var
     */
    protected $user;
    /**
     * List of bbcodes
     */
    const BBCODES_OLD = [
        '~\[br\]~s',
        '~\[h1\](.*?)\[/h1\]~s',
        '~\[h2\](.*?)\[/h2\]~s',
        '~\[h3\](.*?)\[/h3\]~s',
        '~\[h4\](.*?)\[/h4\]~s',
        '~\[h5\](.*?)\[/h5\]~s',
        '~\[b\](.*?)\[/b\]~s',
        '~\[i\](.*?)\[/i\]~s',
        '~\[u\](.*?)\[/u\]~s',
        '~\[quote\](.*?)\[/quote\]~s',
        '~\[size=(.*?)\](.*?)\[/size\]~s',
        '~\[color=(.*?)\](.*?)\[/color\]~s',
        '~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
        '~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s',
    ];
    /**
     * List of bbcode HTML parsed
     */
    const BBCODES_NEW = [
        '<br />',
        '<h1>$1</h1>',
        '<h2>$1</h2>',
        '<h3>$1</h3>',
        '<h4>$1</h4>',
        '<h5>$1</h5>',
        '<b>$1</b>',
        '<i>$1</i>',
        '<span style="text-decoration:underline;">$1</span>',
        '<pre>$1</'.'pre>',
        '<span style="font-size: $1px;">$2</span>',
        '<span style="color: $1;">$2</span>',
        '<a href="$1">$1</a>',
        '<img src="$1" alt="$1" />',
    ];

    /**
     * Constructor
     */
    public function __construct() {
        $this->sql = new Database();
        $this->user = new Admin();
    }
    
    /**
     * Get all pages by name
     * 
     * @return array
     */
    public function getAll(): array {
        return $this->sql->fetch_array("SELECT id, name, slug, category_id FROM pages ORDER BY name ASC;");
    }
    
    /**
     * Get all categories
     * 
     * @return array
     */
    public function getCategories(): array {
        return $this->sql->fetch_array("SELECT * FROM categories;");
    }
    
    /**
     * Get all ASC order by category ID
     * 
     * @param  int    $cat [Category ID]
     * @return array
     */
    public function getAllByCategory(int $cat): array {
        return $this->sql->fetch_array("SELECT id, name, slug, category_id FROM pages WHERE category_id = '{$cat}' ORDER BY name ASC;");
    }
    
    /**
     * Get category name by ID
     * 
     * @param  int    $cat [Category ID]
     * @return string
     */
    public function getCategory(int $cat): string {
        $getCategory = $this->sql->fetch_array("SELECT name FROM categories WHERE id = '{$cat}' LIMIT 1;");
        
        if (empty($getCategory)) {
            return 'Unknown';
        }
        
        return $getCategory[0]['name'];
    }
    
    /**
     * Creates a new category
     * 
     * @param string $name [Category name]
     * @param string $icon [Category icon]
     * @return void
     */
    public function addCategory(string $name, string $icon) {
        return $this->sql->insert('categories', ['name' => $name, 'icon' => $icon]);
    }
    
    /**
     * Update pages by ID
     * 
     * @param  int    $id     [Page ID]
     * @param  string $name   [Page name]
     * @param  string $slug   [Slug URL]
     * @param  string $text   [Post content]
     * @param  int $cat_id [Category ID]
     * @return void
     */
    public function updatePage(int $id, string $name, string $slug, string $text, int $cat_id) {
        return $this->sql->update('pages', ['name' => $name, 'slug' => $slug, 'content' => $text, 'category_id' => $cat_id], ['id' => $id]);
    }
    
    /**
     * Adds a new page
     * 
     * @param  string $name   [Page name]
     * @param  string $slug   [Slug URL]
     * @param  string $text   [Post content]
     * @param  int $cat_id [Category ID]
     * @return void
     */
    public function addPage(string $name, string $slug, string $text, int $cat_id) {
        return $this->sql->insert('pages', ['name' => $name, 'slug' => $slug, 'content' => $text, 'category_id' => $cat_id]);
    }
    
    /**
     * Deletes a page by ID
     * 
     * @param  int    $id [Page ID]
     * @return void
     */
    public function deletePage(int $id) {
        return $this->sql->query("DELETE FROM pages WHERE id = '{$id}';");
    }
    
    /**
     * Deletes a category by ID
     * 
     * @param  int    $id [Page ID]
     * @return void
     */
    public function deleteCategory(int $id) {
        return $this->sql->query("DELETE FROM categories WHERE id = '{$id}';");
    }
    
    /**
     * Get a page by slug
     * 
     * @param  string $slug [Page URL]
     * @return array
     */
    public function getBySlug(string $slug): array {
        return $this->sql->fetch_array("SELECT * FROM pages WHERE slug = '{$slug}';");
    }
    
    /**
     * Get a page by slug
     * 
     * @param  string $slug [Page URL]
     * @return array
     */
    public function getById(int $id): array {
        return $this->sql->fetch_array("SELECT * FROM pages WHERE id = '{$id}';");
    }
    
    /**
     * Parse all BBcodes to HTML
     * Also fixes highlight bug caused by minify system
     * 
     * @param  string $html [HTML mixed with BBcodes]
     * @return string
     */
    public function parseBBcodes(string $html): string {
        $html = str_replace('<?php', '<?php ', $html);
        $html = preg_replace_callback('#\[code](.*?)\[\/code]#is',
            function ($matches) {
                if ($this->user->getConfig('highlight') === '1') {
                    return '<pre>' . highlight_string($matches[1], true) . '</pre>';
                } else {
                    return '<br /><pre><code>' . nl2br(htmlspecialchars($matches[1])) . '</code></pre>';
                }
            },
            $html
        );
        $html = preg_replace(self::BBCODES_OLD, self::BBCODES_NEW, $html);
        return $html;        
    }
}
