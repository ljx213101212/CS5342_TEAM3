function G = getG(rows, cols)
% compute the parameter matrix G for iterative reweighted least square
% @param rows: the rows of image
% @param cols: the cols of image
% RETURN G: the parameter matrix [struct: G.x, G.y, G.xx, G.xy, G.yy]
    
    img_size = rows * cols;

    Gx1_idx = zeros(img_size * 2, 1);
    Gx2_idx = zeros(img_size * 2, 1);
    Gx_values = zeros(img_size * 2, 1);
    Gy1_idx = zeros(img_size * 2, 1);
    Gy2_idx = zeros(img_size * 2, 1);
    Gy_values = zeros(img_size * 2, 1);

    y_idx = 0;
    x_idx = 0;
    dS=[1,-1];
    for i = 0 : 1,
        for x = 1 : cols-1,	
           for y = 1 : rows,
              x_idx = x_idx + 1;
              Gx1_idx(x_idx)= sub2ind([rows, cols], y, x);
              Gx2_idx(x_idx)= sub2ind([rows, cols], y, x + i);
              Gx_values(x_idx) = dS(i+1);
           end
        end
        for x = 1 : cols
           for y = 1 : rows - 1
               y_idx = y_idx + 1;
               Gy1_idx(y_idx) = sub2ind([rows, cols], y, x);
               Gy2_idx(y_idx) = sub2ind([rows, cols], y + i, x);
               Gy_values(y_idx) = dS(i + 1);
           end;
        end;
    end;

    Gx1_idx = Gx1_idx(1 : x_idx);
    Gx2_idx = Gx2_idx(1 : x_idx);
    Gx_values = Gx_values(1 : x_idx);
    Gy1_idx = Gy1_idx(1 : y_idx);
    Gy2_idx = Gy2_idx(1 : y_idx);
    Gy_values = Gy_values(1 : y_idx);
    G.Gx=sparse(Gx1_idx,Gx2_idx,Gx_values,img_size,img_size);
    G.Gy=sparse(Gy1_idx,Gy2_idx,Gy_values,img_size,img_size);

    G.Gxx = G.Gx' * G.Gx;
    G.Gxy = G.Gx * G.Gy;
    G.Gyy = G.Gy' * G.Gy;
    
    nzGxx = sum(G.Gxx ~= 0, 2);
    nzGyy = sum(G.Gyy ~= 0, 2);
    nzGxy = sum(G.Gxy ~= 0, 2);
    fzGxx = nzGxx ~= 3;
    fzGyy = nzGyy ~= 3;
    fzGxy = nzGxy ~= 4;
    G.Gxx(fzGxx, :) = 0;
    G.Gyy(fzGyy, :) = 0;
    G.Gxy(fzGxy, :) = 0;

end