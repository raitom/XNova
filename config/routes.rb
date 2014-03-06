XNova::Application.routes.draw do
  devise_for :players
  root "static_pages#index"


end
