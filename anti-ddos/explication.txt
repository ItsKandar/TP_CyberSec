C'est pas un bon filtre mais c'est ce qui a été demandé

Proposer un filtre anti ddos client "BASIQUE"
A chaque requête, si il n'existe pas, créer un cookie "ddos" avec une durée de vie de 90 secondes
Si il existe, incrementer le compteur

Si le cookie (compteur) est a plus de 10, alors bloquer la requête et rediriger l'utilisateur vers une page "ANTI-DDOS"