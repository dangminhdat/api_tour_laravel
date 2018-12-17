<?php

namespace Core\Repositories;

use App\Image;

/**
 * Class ImageRepository
 */
class ImageRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param Image $model [description]
     */
    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        $images = $this->model->where(['deleted_at' => 0])->orderBy('id', 'DESC')->get();
        foreach ($images as $key => $image) {
            $images[$key]['id_detail_tour'] = $image->tour->detail_tour->first()->id;
            $images[$key]['name_tour'] = $image->tour->name;
            unset($images[$key]['tour']);
            unset($images[$key]['deleted_at']);
        }
        return $images;
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        $images = $this->model->where(['id_tour' => $id, 'deleted_at' => 0])->orderBy('id', 'DESC')->get();
        foreach ($images as $key => $image) {
            unset($images[$key]['deleted_at']);
            unset($images[$key]['id_tour']);
        }
        return $images;
    }

    /**
     * Store
     * @param array $data
     * @return mixed
     */
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
                'description'   => $data['description'],
                'url'           => '/uploads/'.$name,
                'id_tour'       => $data['id_tour']
            ];
            $this->model->create($insert);
        }
        
        return true;
    }

    /**
     * Update
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $model = $this->model->where(['id' => $id, 'deleted_at' => 0]);
        return $model->update($data);
    }

    /**
     * Destroy
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        return $model->destroy($id);
    }
}
