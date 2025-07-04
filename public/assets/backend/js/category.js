function deleteCategory(id){
    if(confirm("Are you sure to delete this record?"))
        window.livewire.emit('deleteCategoryListner',id);
}