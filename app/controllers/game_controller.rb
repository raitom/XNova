class GameController < ApplicationController
  before_filter :check_connexion

  private

  #Redirect player to the login page if he is not connected
  def check_connexion
     redirect_to(root_path) unless player_signed_in?
  end
end