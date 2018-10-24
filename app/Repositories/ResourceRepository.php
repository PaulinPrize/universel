<?php

namespace App\Repositories;

abstract class ResourceRepository
{

    protected $model;

	/*
		1- Méthode appelée depuis la méthode index du controleur
		   Cette méthode répond à l'url du type:get
	*/
    public function getPaginate($n)
	{
		return $this->model->paginate($n);
	}

	/*
		2- La méthode  findOrFail essaie de récupérer dans la table l'enregistrement dont on 	transmet l'id. Si elle n'y parvient pas elle génère une erreur d'exécution.
	*/
	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	/*
		3- Cette méthode est destinée à mettre à jour l'enregistrement dans la table à partir 	 des données transmises comme paramètres :
	*/
	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}

	/*
		On crée un nouvel objet User. On renseigne l'attribut  password et on enregistre dans la table avec la méthode privée  save que nous avons déjà vue ci-dessus :
	*/
	public function store(Array $inputs)
	{
		return $this->model->create($inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}
}


