<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
  
  #[Assert\NotBlank(message: 'Vous devez donner un nom valide.')]
  #[Assert\Length(
    min: 3,
    max: 100,
  )]
  public string $name = '';
  
  #[Assert\NotBlank(message: 'Vous devez donner un email valide.')]
  #[Assert\Email(message: 'Vous devez donner un email valide.')]
  public string $email = '';
  
  #[Assert\NotBlank(message: 'Vous devez remplir un message.')]
  public string $message = '';
  
  #[Assert\NotBlank(message: 'Vous devez choisir un service.')]
  public string $service = '';
  
}