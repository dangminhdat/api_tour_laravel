<?php

namespace Core\Services;

/**
 * Interface ServiceInterface
 */
interface ServiceInterface
{
	/**
     * All
     * @return array
     */
    public function paginate();

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id);

    /**
     * Store
     * @param array $data
     * @return mixed
     */
    public function store($data);

    /**
     * Update
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data);

    /**
     * Destroy
     * @param int $id
     * @return mixed
     */
    public function destroy($id);
}
