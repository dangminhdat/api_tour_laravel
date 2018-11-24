<?php

namespace Core\Repositories;

use App\Image;

class ImageRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $images = $this->model->where(['deleted_at' => 0])->orderBy('id', 'DESC')->get();
        foreach ($images as $key => $image) {
            $images[$key]['name_tour'] = $image->tour->name;
            unset($images[$key]['tour']);
            unset($images[$key]['deleted_at']);
        }
        return $images;
    }

    public function find($id)
    {
        $images = $this->model->where(['id_tour' => $id, 'deleted_at' => 0])->orderBy('id', 'DESC')->get();
        foreach ($images as $key => $image) {
            unset($images[$key]['deleted_at']);
            unset($images[$key]['id_tour']);
        }
        return $images;
    }

    public function store($data)
    {
        $upload = public_path()."/uploads/";
        if(!is_dir($upload)) {
            mkdir($upload);
        }
        foreach ($data['images']['name'] as $key => $value) {
            $ext = explode('.',$data['images']['name'][$key]);
            $ext = $ext[count($ext) - 1];
            $tmp = $data['images']['tmp_name'][$key];
            $name = uniqid()."-".date("Y-m-d-H-i-s").'.'.$ext;
            @move_uploaded_file($tmp, $upload.$name);
            $insert = [
                'name'      => $name,
                'url'       => '/uploads/'.$name,
                'id_tour'   => $data['id_tour']
            ];
            $this->model->create($insert);
        }
        
        return true;
    }

    public function update($id, $data)
    {
        $model = $this->model->where(['id' => $id, 'deleted_at' => 0]);
        return $model->update($data);
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        return $model->destroy($id);
    }
}