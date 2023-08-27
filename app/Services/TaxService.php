<?php

namespace App\Services;

use App\Exceptions\DeleteFailedException;
use App\Exceptions\DuplicateEntryException;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateFailedException;
use App\Repositories\TaxRepository;
use App\Repositories\ProductRepository;

class TaxService extends BaseService
{
    private $taxRepository;
    private $productRepository;

    public function __construct(TaxRepository $taxRepository, ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->taxRepository = $taxRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->taxRepository->getAll();
    }

    public function getProductTaxByProductId($productId)
    {
        if(!validate_id($productId)) {
            throw new InvalidParameterException("Invalid product ID $productId");
        }

        $product = $this->productRepository->get($productId);
        $tax = $this->taxRepository->get($product->tax_id);

        return $tax;
    }

    public function findById($id)
    {
        return $this->taxRepository->get($id);
    }

    public function updateTax($data)
    {
        $taxId = $data['id'];
        if (!$this->taxRepository->get($taxId)) {
            throw new NotFoundException("Not found tax has ID: $taxId");
        }
        if ($this->taxRepository->update($data)) {
            return $this->taxRepository->get($taxId);
        } else {
            throw new UpdateFailedException("Update failed tax record has ID: $taxId");
        }
    }

    public function createTax($data)
    {
        $name = $data['name'];
        $value = $data['value'];

        if (!$this->taxRepository->findByName($name)) {
            throw new DuplicateEntryException("Name `$name` already exist in tax records");
        }
        return $this->taxRepository->create($name, $value);
    }

    public function deleteTax($id)
    {
        if(!validate_id($id)) {
            throw new InvalidParameterException("Invalid tax ID $id");
        }
        if(!$this->taxRepository->get($id)) {
            throw new InvalidParameterException("Not found tax has ID: $id");
        }
        if (!$this->taxRepository->remove($id)) {
            throw new DeleteFailedException("Failed to delete tax has ID: $id");
        }
    }
}
