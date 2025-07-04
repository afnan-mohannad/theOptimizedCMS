<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;

class PagesShow extends Component
{
    public $page, $title_en, $title_ar, $slug, $excerpt_en, $excerpt_ar, $body_en, $body_ar, $status, $created_at;

    public function mount($id)
    {
        $this->page = Page::find($id);
        $translations_array = $this->page->getTranslationsArray();
        $this->title_en  = $translations_array['en']['title'];
        $this->title_ar   = $translations_array['ar']['title'];
        $this->excerpt_en = $translations_array['en']['excerpt'];
        $this->excerpt_ar = $translations_array['ar']['excerpt'];
        $this->body_en    = $translations_array['en']['body'];
        $this->body_ar    = $translations_array['ar']['body'];
        $this->status     = $this->page->status;
        $this->slug       = $this->page->slug;

    }
    
    public function render()
    {
        return view('livewire.admin.pages.pages-show');
    }
}
