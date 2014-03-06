class StaticPagesController < ApplicationController
  def index
    redirect_to overview_index_path if player_signed_in?
  end
end