using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack.model.rules

{
  class Soft17HitStrategy : IHitStrategy
  {
    private const int g_hitLimit = 17;

    public bool DoHit(model.Player a_dealer)
    {
      foreach (Card c in a_dealer.GetHand())
      {
        if (c.GetValue() == Card.Value.Ace && a_dealer.CalcScore() == g_hitLimit)
        {
            return true;
        }
      }
      return a_dealer.CalcScore() < g_hitLimit;
    }
  }
}

